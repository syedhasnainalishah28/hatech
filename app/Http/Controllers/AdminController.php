<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Product;
use App\Models\User;
use App\Models\TeamMember;
use App\Models\SitePage;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderUpdate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function toggleMaintenance(Request $request) {
        $isDown = App::isDownForMaintenance();
        
        if ($isDown) {
            Artisan::call('up');
            return back()->with('success', 'Website is now LIVE.');
        } else {
            // Use the secret token for bypass
            Artisan::call('down', [
                '--secret' => 'hasnain-access'
            ]);
            return back()->with('success', 'Maintenance Mode ON. Use /hasnain-access to bypass.');
        }
    }
    
    public function toggleDevMode(Request $request) {
        $current = \App\Models\SiteSetting::get('developer_mode', false);
        \App\Models\SiteSetting::set('developer_mode', !$current, 'boolean');
        
        // This is a logic placeholder - actual APP_DEBUG is in .env 
        // In a real environment, we would also update the .env file if permissions exist
        // or use the SiteSetting in the AppServiceProvider to override config
        
        return back()->with('success', 'Development Mode ' . (!$current ? 'ON' : 'OFF'));
    }
    public function activityLogs() {
        $logs = \App\Models\AdministrativeLog::with('admin')->latest()->paginate(20);
        return view('admin.logs', compact('logs'));
    }

    public function dashboard() {
        $stats = [
            'revenue' => Order::where('status', 'completed')->sum('total') ?? 0,
            'users' => User::count(),
            'products' => Product::count(),
            'orders' => Order::count()
        ];
        
        $recentOrders = Order::with('buyer')->latest()->take(5)->get();
        $recentPortfolios = Portfolio::latest()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentPortfolios'));
    }

    // --- Portfolios ---
    public function portfolios() {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolios.index', compact('portfolios'));
    }
    public function portfolioCreate() { return view('admin.portfolios.create'); }
    public function portfolioStore(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'year' => 'required|string|max:10',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'nullable',
            'sections' => 'nullable|array'
        ]);

        $validated['slug'] = $request->slug ?: Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('portfolios/thumbnails', 'public');
        }

        $sections = $request->input('sections', []);
        foreach ($sections as $index => &$section) {
            // Handle Media Uploads in Sections
            if ($request->hasFile("sections.$index.media_file")) {
                $section['media_url'] = $request->file("sections.$index.media_file")->store('portfolios/sections', 'public');
            }
            if ($request->hasFile("sections.$index.lottie_file")) {
                $section['lottie_path'] = $request->file("sections.$index.lottie_file")->store('portfolios/lottie', 'public');
            }
        }
        $validated['layout_sections'] = $sections;
        $validated['is_featured'] = $request->has('is_featured');

        Portfolio::create($validated);
        return redirect()->route('admin.portfolios')->with('success', 'Portfolio created successfully.');
    }

    public function portfolioEdit($id) {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function portfolioUpdate(Request $request, $id) {
        $portfolio = Portfolio::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'year' => 'required|string|max:10',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'nullable',
            'sections' => 'nullable|array'
        ]);

        $validated['slug'] = $request->slug ?: Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            if ($portfolio->image_path) Storage::disk('public')->delete($portfolio->image_path);
            $validated['image_path'] = $request->file('image')->store('portfolios/thumbnails', 'public');
        }

        $sections = $request->input('sections', []);
        $existingSections = $portfolio->layout_sections ?? [];

        foreach ($sections as $index => &$section) {
            // Retain existing media if no new file uploaded
            if (!$request->hasFile("sections.$index.media_file")) {
                $section['media_url'] = $section['media_url'] ?? ($existingSections[$index]['media_url'] ?? null);
            } else {
                $section['media_url'] = $request->file("sections.$index.media_file")->store('portfolios/sections', 'public');
            }

            if (!$request->hasFile("sections.$index.lottie_file")) {
                $section['lottie_path'] = $section['lottie_path'] ?? ($existingSections[$index]['lottie_path'] ?? null);
            } else {
                $section['lottie_path'] = $request->file("sections.$index.lottie_file")->store('portfolios/lottie', 'public');
            }
        }

        $validated['layout_sections'] = $sections;
        $validated['is_featured'] = $request->has('is_featured');

        $portfolio->update($validated);
        return redirect()->route('admin.portfolios')->with('success', 'Portfolio updated successfully.');
    }
    public function portfolioDestroy($id) {
        $portfolio = Portfolio::findOrFail($id);
        if ($portfolio->image) Storage::disk('public')->delete($portfolio->image);
        $portfolio->delete();
        return redirect()->route('admin.portfolios')->with('success', 'Portfolio deleted successfully.');
    }

    // --- Testimonials ---
    public function testimonials() {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }
    public function testimonialCreate() { return view('admin.testimonials.create'); }
    public function testimonialStore(Request $request) {
        $validated = $request->validate(['client_name' => 'required', 'company' => 'nullable', 'position' => 'nullable', 'content' => 'required', 'rating' => 'required|numeric|min:1|max:5', 'image' => 'nullable|image', 'is_approved' => 'boolean']);
        if ($request->hasFile('image')) { $validated['image'] = $request->file('image')->store('testimonials', 'public'); }
        Testimonial::create($validated);
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial created successfully.');
    }
    public function testimonialEdit($id) {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }
    public function testimonialUpdate(Request $request, $id) {
        $testimonial = Testimonial::findOrFail($id);
        $validated = $request->validate(['client_name' => 'required', 'company' => 'nullable', 'position' => 'nullable', 'content' => 'required', 'rating' => 'required|numeric|min:1|max:5', 'image' => 'nullable|image', 'is_approved' => 'boolean']);
        if (!isset($validated['is_approved'])) $validated['is_approved'] = 0;
        if ($request->hasFile('image')) { 
            if ($testimonial->image) Storage::disk('public')->delete($testimonial->image);
            $validated['image'] = $request->file('image')->store('testimonials', 'public'); 
        }
        $testimonial->update($validated);
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial updated successfully.');
    }
    public function testimonialDestroy($id) {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->image) Storage::disk('public')->delete($testimonial->image);
        $testimonial->delete();
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial deleted successfully.');
    }
    public function testimonialApprove(Request $request, $id) {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'Testimonial approved successfully.');
    }

    // --- Pages ---
    public function pages() {
        $pages = SitePage::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }
    public function pageCreate() { return view('admin.pages.create'); }
    public function pageStore(Request $request) {
        $request->validate(['name' => 'required', 'slug' => 'required']);
        $page = new SitePage();
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->html_content = $request->html_content;
        $page->components_json = [];
        $page->save();
        return redirect()->route('admin.pages')->with('success', 'Page created successfully.');
    }
    
    public function pageEdit($id) {
        $page = SitePage::findOrFail($id);
        
        if ($page->slug === 'about') {
            return view('admin.pages.edit_about', compact('page'));
        } elseif (in_array($page->slug, ['founder', 'ceo'])) {
            return view('admin.pages.edit_profile', compact('page'));
        }
        return view('admin.pages.edit', compact('page'));
    }
    
    public function pageUpdate(Request $request, $id) {
        $page = SitePage::findOrFail($id);
        
        // Update Core Fields
        $page->name = $request->name;
        if ($request->has('slug')) {
            $page->slug = $request->slug;
            $page->html_content = $request->html_content;
        }

        // Update High-Authority SEO Fields
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->schema_markup = $request->schema_markup;

        // Handle Specialized Components
        if (in_array($page->slug, ['founder', 'ceo', 'about']) && ($request->has('biography') || $request->has('hero_title'))) {
            // Visual Form Handling takes priority for known pages
            $components = $page->components_json ?? [];

            if (in_array($page->slug, ['founder', 'ceo'])) {
                $components['designation'] = $request->designation;
                $components['biography'] = $request->biography;
                $components['linkedin'] = $request->linkedin;
                $components['twitter'] = $request->twitter;
                $components['email'] = $request->email;
                $components['quote'] = $request->quote;
                $components['stat1_label'] = $request->stat1_label;
                $components['stat1_value'] = $request->stat1_value;
                $components['stat2_label'] = $request->stat2_label;
                $components['stat2_value'] = $request->stat2_value;

                // Handle Mastery Index (Repeater)
                if ($request->has('mastery')) {
                    $components['mastery_index'] = array_values($request->mastery);
                }

                // Handle Timeline (Repeater)
                if ($request->has('timeline')) {
                    $components['experience_timeline'] = array_values($request->timeline);
                }

                // Handle Qualifications (Repeater)
                if ($request->has('honor')) {
                    $components['qualifications'] = array_values($request->honor);
                }

                // Handle Gallery (Multi-file Repeater)
                if ($request->has('gallery')) {
                    $galleryData = [];
                    foreach ($request->gallery as $key => $item) {
                        $path = $item['existing'] ?? null;
                        if ($request->hasFile("gallery.$key.file")) {
                            $path = $request->file("gallery.$key.file")->store('profiles/gallery', 'public');
                        }
                        
                        if ($path) {
                            $galleryData[] = [
                                'url' => $path,
                                'caption' => $item['caption'] ?? ''
                            ];
                        }
                    }
                    $components['gallery'] = $galleryData;
                }

                if ($request->hasFile('image')) {
                    $components['image_path'] = $request->file('image')->store('profiles', 'public');
                    unset($components['primary_image']);
                }
            } elseif ($page->slug === 'about') {
                $components['hero_title'] = $request->hero_title;
                $components['hero_subtitle'] = $request->hero_subtitle;
                $components['story_title'] = $request->story_title;
                $components['story_content'] = $request->story_content;
                $components['mission_desc'] = $request->mission_desc;
                $components['vision_desc'] = $request->vision_desc;
                $components['excellence_desc'] = $request->excellence_desc;
            }
            $page->components_json = $components;
        } elseif ($request->filled('components_json_raw')) {
            // Direct JSON Override (Technical Area)
            $decoded = json_decode($request->components_json_raw, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $page->components_json = $decoded;
            }
        }

        $page->save();

        return redirect()->route('admin.pages')->with('success', 'Page identity and SEO updated successfully.');
    }
    public function pageDestroy($id) {
        $page = SitePage::findOrFail($id);
        $page->delete();
        return redirect()->route('admin.pages')->with('success', 'Page deleted successfully.');
    }

    // --- Products ---
    public function products() {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    public function productCreate() { return view('admin.products.create'); }
    public function productStore(Request $request) {
        $validated = $request->validate([
            'title' => 'required', 'description' => 'nullable', 'price' => 'required|numeric', 
            'sale_price' => 'nullable|numeric', 'type' => 'required', 'category_id' => 'nullable|exists:categories,id', 
            'stock' => 'nullable|integer', 'status' => 'required', 'thumbnail' => 'nullable|image', 'file' => 'nullable|file'
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['seller_id'] = auth()->id() ?? 1;
        
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }
        if ($request->hasFile('file') && $validated['type'] === 'digital') {
            $path = $request->file('file')->store('products/files', 'public');
            $validated['file_url'] = Storage::url($path);
        }
        
        Product::create($validated);
        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }
    public function productEdit($id) {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }
    public function productUpdate(Request $request, $id) {
        $product = Product::findOrFail($id);
        $validated = $request->request->all();
        
        $rules = [
            'title' => 'required', 'description' => 'nullable', 'price' => 'required|numeric', 
            'sale_price' => 'nullable|numeric', 'type' => 'required', 'category_id' => 'nullable|exists:categories,id', 
            'stock' => 'nullable|integer', 'status' => 'required', 'thumbnail' => 'nullable|image', 'file' => 'nullable|file'
        ];
        $validated = $request->validate($rules);
        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) Storage::disk('public')->delete($product->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }
        if ($request->hasFile('file') && $validated['type'] === 'digital') {
            $path = $request->file('file')->store('products/files', 'public');
            $validated['file_url'] = Storage::url($path);
        }
        
        $product->update($validated);
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }
    public function productDestroy($id) {
        $product = Product::findOrFail($id);
        if ($product->thumbnail) Storage::disk('public')->delete($product->thumbnail);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    // --- Users ---
    public function users() {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    // --- Service Orders ---
    public function serviceOrders() {
        $orders = \App\Models\ServiceOrder::with('user')->latest()->paginate(15);
        return view('admin.service_orders.index', compact('orders'));
    }

    public function serviceOrderShow($id) {
        $order = \App\Models\ServiceOrder::with(['user', 'updates'])->findOrFail($id);
        return view('admin.service_orders.show', compact('order'));
    }

    public function serviceOrderUpdate(Request $request, $id) {
        $order = \App\Models\ServiceOrder::findOrFail($id);
        
        $request->validate([
            'status' => 'required',
            'update_message' => 'nullable|string',
            'proof_image' => 'nullable|image',
            'price' => 'nullable|numeric'
        ]);

        $order->status = $request->status;
        if ($request->filled('price')) {
            $order->price = $request->price;
        }
        $order->save();

        $update = null;
        if ($request->filled('update_message') || $request->hasFile('proof_image')) {
            $update = new \App\Models\ServiceOrderUpdate();
            $update->service_order_id = $order->id;
            $update->message = $request->update_message ?? "Status changed to " . $order->status;
            
            if ($request->hasFile('proof_image')) {
                $update->proof_image = $request->file('proof_image')->store('service_proofs', 'public');
            }
            $update->save();
        }

        // Send Email Notification
        try {
            \Mail::to($order->user->email)->send(new \App\Mail\OrderTrackingEmail($order, $update));
        } catch (\Exception $e) {
            \Log::error("Failed to send tracking email: " . $e->getMessage());
        }

        return back()->with('success', 'Order updated and client notified.');
    }

    // --- Email Marketing ---
    public function emailTemplates() {
        $templates = \App\Models\EmailTemplate::latest()->paginate(10);
        return view('admin.email_templates.index', compact('templates'));
    }

    public function emailTemplateCreate() {
        return view('admin.email_templates.create');
    }

    public function emailTemplateStore(Request $request) {
        $data = $request->validate([
            'template_name' => 'required',
            'subject' => 'required',
            'brand_name' => 'required',
            'tagline' => 'required',
            'content' => 'required',
            'contact_phone' => 'nullable',
            'contact_email' => 'nullable',
            'website_url' => 'nullable',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('email_branding', 'public');
        }

        \App\Models\EmailTemplate::create($data);
        return redirect()->route('admin.email_templates')->with('success', 'Template created successfully.');
    }

    public function emailTemplateEdit($id) {
        $template = \App\Models\EmailTemplate::findOrFail($id);
        return view('admin.email_templates.edit', compact('template'));
    }

    public function emailTemplateUpdate(Request $request, $id) {
        $template = \App\Models\EmailTemplate::findOrFail($id);
        $data = $request->validate([
            'template_name' => 'required',
            'subject' => 'required',
            'brand_name' => 'required',
            'tagline' => 'required',
            'content' => 'required',
            'contact_phone' => 'nullable',
            'contact_email' => 'nullable',
            'website_url' => 'nullable',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('email_branding', 'public');
        }

        $template->update($data);
        return redirect()->route('admin.email_templates')->with('success', 'Template updated successfully.');
    }

    public function emailTemplateDestroy($id) {
        \App\Models\EmailTemplate::findOrFail($id)->delete();
        return redirect()->route('admin.email_templates')->with('success', 'Template deleted successfully.');
    }

    public function sendEmailForm(Request $request) {
        $templates = \App\Models\EmailTemplate::all();
        $targetUser = null;
        if ($request->has('user_id')) {
            $targetUser = User::find($request->user_id);
        }
        return view('admin.emails.send', compact('templates', 'targetUser'));
    }

    public function sendEmail(Request $request) {
        $request->validate([
            'template_id' => 'required',
            'message_content' => 'required',
            'recipient_type' => 'required|in:all,single',
            'user_id' => 'required_if:recipient_type,single'
        ]);

        $template = \App\Models\EmailTemplate::findOrFail($request->template_id);
        $users = [];

        if ($request->recipient_type === 'single') {
            $users = [User::findOrFail($request->user_id)];
        } else {
            $users = User::where('role', 'buyer')->get();
        }

        foreach ($users as $user) {
            try {
                \Mail::to($user->email)->send(new \App\Mail\DynamicEmail($template, $request->message_content, $user));
            } catch (\Exception $e) {
                \Log::error("Failed to send dynamic email to {$user->email}: " . $e->getMessage());
            }
        }

        return redirect()->route('admin.users')->with('success', 'Emails dispatched successfully.');
    }
    /*** SERVICES MANAGEMENT ***/
    public function services()
    {
        $services = \App\Models\Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function serviceCreate()
    {
        return view('admin.services.create');
    }

    public function serviceStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|string',
            'gradient_class' => 'required|string',
            'file_limit' => 'required|integer|min:1',
            'custom_fields' => 'nullable|string' // Expecting JSON string from frontend
        ]);

        if ($data['custom_fields']) {
            $data['custom_fields'] = json_decode($data['custom_fields'], true);
        } else {
            $data['custom_fields'] = [];
        }

        \App\Models\Service::create($data);

        return redirect()->route('admin.services')->with('success', 'Service created successfully.');
    }

    public function serviceEdit($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function serviceUpdate(Request $request, $id)
    {
        $service = \App\Models\Service::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|string',
            'gradient_class' => 'required|string',
            'file_limit' => 'required|integer|min:1',
            'custom_fields' => 'nullable|string'
        ]);

        if ($data['custom_fields']) {
            $data['custom_fields'] = json_decode($data['custom_fields'], true);
        } else {
            $data['custom_fields'] = [];
        }

        $service->update($data);

        return redirect()->route('admin.services')->with('success', 'Service updated successfully.');
    }

    public function serviceDestroy($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Service deleted successfully.');
    }

    // --- Team Members ---
    public function teamIndex()
    {
        $members = TeamMember::orderBy('sort_order')->paginate(10);
        return view('admin.team.index', compact('members'));
    }

    public function teamCreate()
    {
        return view('admin.team.create');
    }

    public function teamStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:team_members,slug',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'expertise' => 'nullable|string',
            'achievements' => 'nullable|string',
            'gradient' => 'required|string|max:255',
            'image_path' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|string',
            'twitter_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'github_url' => 'nullable|string',
            'email' => 'nullable|string',
            'sort_order' => 'required|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'schema_markup' => 'nullable|string'
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('team', 'public');
        }

        TeamMember::create($data);

        return redirect()->route('admin.team')->with('success', 'Team member added successfully.');
    }

    public function teamEdit($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('member'));
    }

    public function teamUpdate(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:team_members,slug,' . $id,
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'expertise' => 'nullable|string',
            'achievements' => 'nullable|string',
            'gradient' => 'required|string|max:255',
            'image_path' => 'nullable|image|max:2048',
            'linkedin_url' => 'nullable|string',
            'twitter_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'github_url' => 'nullable|string',
            'email' => 'nullable|string',
            'sort_order' => 'required|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'schema_markup' => 'nullable|string'
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image_path')) {
            if ($member->image_path) {
                \Storage::disk('public')->delete($member->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('team', 'public');
        }

        $member->update($data);

        return redirect()->route('admin.team')->with('success', 'Team member updated successfully.');
    }

    public function teamDestroy($id)
    {
        $member = TeamMember::findOrFail($id);
        if ($member->image_path) {
            Storage::disk('public')->delete($member->image_path);
        }
        $member->delete();
        return redirect()->route('admin.team')->with('success', 'Team member deleted successfully.');
    }
}
