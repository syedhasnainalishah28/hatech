<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\SitePage;
use App\Models\ServiceOrder;
use App\Models\Service;
use App\Models\TeamMember;
use App\Mail\WelcomeEmail;

class FrontendController extends Controller
{
    public function home() 
    { 
        $portfolios = Portfolio::latest()->take(6)->get();
        $testimonials = Testimonial::latest()->take(6)->get();

        return view('frontend.home', compact('portfolios', 'testimonials')); 
    }
    public function services() { 
        $services = Service::where('is_active', true)->get();
        return view('frontend.services', compact('services')); 
    }
    
    public function work() 
    { 
        $portfolios = Portfolio::latest()->paginate(12);
        return view('frontend.portfolio', compact('portfolios')); 
    }
    
    public function portfolioShow($id)
    {
        $portfolio = Portfolio::where('slug', $id)->first();
        if (!$portfolio) {
            $portfolio = Portfolio::findOrFail($id);
        }
        return view('frontend.portfolio-show', compact('portfolio'));
    }
    
    public function blogs() 
    { 
        $posts = BlogPost::with('author', 'category')
                        ->where('status', 'published')
                        ->orderByDesc('published_at')
                        ->paginate(9);
        return view('frontend.blogs', compact('posts')); 
    }

    public function blogSingle($slug)
    {
        $post = BlogPost::with('author', 'category')
                        ->where('slug', $slug)
                        ->where('status', 'published')
                        ->firstOrFail();
        return view('frontend.blog-single', compact('post'));
    }

    public function sitemap()
    {
        $posts = BlogPost::where('status', 'published')->orderByDesc('published_at')->get();
        $portfolios = Portfolio::latest()->get();
        $members = TeamMember::where('is_active', true)->get();
        
        // Return view as XML
        return response()->view('frontend.sitemap', [
            'posts' => $posts,
            'portfolios' => $portfolios,
            'members' => $members
        ])->header('Content-Type', 'text/xml');
    }

    public function team()
    {
        $team = \App\Models\TeamMember::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.team', compact('team'));
    }
    
    public function about() 
    { 
        $page = SitePage::firstOrNew(['slug' => 'about'], ['html_content' => '', 'components_json' => []]);
        return view('frontend.about.index', compact('page')); 
    }
    
    public function teamSingle($slug)
    {
        $member = TeamMember::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('frontend.team-single', compact('member'));
    }

    public function founder() 
    { 
        $page = SitePage::where('slug', 'founder')->firstOrFail();
        return view('frontend.about.founder', compact('page')); 
    }
    
    public function ceo() 
    { 
        $page = SitePage::where('slug', 'ceo')->firstOrFail();
        return view('frontend.about.ceo', compact('page')); 
    }
    public function products() { return view('frontend.products'); }
    public function marketplace() { return view('frontend.marketplace'); }
    public function contact() { return view('frontend.contact'); }

    public function postContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        return back()->with('success', 'Your message has been sent successfully.');
    }

    public function submitTestimonial(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        
        Testimonial::create([
            'client_name' => $validated['name'],
            'company' => $validated['company'],
            'position' => $validated['position'],
            'content' => $validated['content'],
            'rating' => $validated['rating'],
            'is_approved' => false,
        ]);

        return back()->with('success', 'Thank you! Your testimonial has been submitted for review.');
    }

    public function login() { return view('auth.login'); }
    
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/user/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function signup() { return view('auth.register'); }

    public function postSignup(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'buyer',
        ]);

        Auth::login($user);

        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
        } catch (\Exception $e) {
            Log::error("Failed to send welcome email: " . $e->getMessage());
        }

        return redirect('/user/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function userDashboard()
    {
        $userId = auth()->id();
        $totalOrders = \App\Models\Order::where('buyer_id', $userId)->count();
        $totalSpent = \App\Models\Order::where('buyer_id', $userId)->where('status', 'completed')->sum('total');
        $digitalProductsCount = \App\Models\Order::where('buyer_id', $userId)
            ->where('status', 'completed')
            ->with('items.product')
            ->get()
            ->flatMap(function($order) {
                return $order->items->map(function($item) {
                    return $item->product;
                });
            })
            ->filter(function($product) {
                return $product && $product->file_path; // Assuming file_path presence means digital asset
            })
            ->count();
            
        $recentOrders = \App\Models\Order::with('items.product')
            ->where('buyer_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.user.dashboard', compact(
            'totalOrders', 
            'totalSpent', 
            'digitalProductsCount', 
            'recentOrders'
        ));
    }

    public function userOrders() { 
        $orders = \App\Models\Order::with('items.product')->where('buyer_id', auth()->id())->latest()->paginate(10);
        $serviceOrders = \App\Models\ServiceOrder::where('user_id', auth()->id())->latest()->get();
        return view('frontend.user.orders', compact('orders', 'serviceOrders')); 
    }
    public function userDownloads() { 
        $downloads = \App\Models\OrderItem::whereHas('order', function($q) {
                $q->where('buyer_id', auth()->id())->where('status', 'completed');
            })
            ->with('product')
            ->latest()
            ->get();
        return view('frontend.user.downloads', compact('downloads')); 
    }
    public function userSettings() { 
        $user = auth()->user();
        return view('frontend.user.settings', compact('user')); 
    }
    
    public function userSettingsUpdate(Request $request) 
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        
        $user->update($validated);
        return back()->with('success', 'Settings updated successfully.');
    }

    public function postServiceOrder(Request $request) {
        $data = $request->validate([
            'service_name' => 'required',
            'requirements' => 'required',
            'requirements_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip|max:10240',
            'project_tech' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'budget' => 'nullable|string',
            'timeline' => 'nullable|string'
        ]);

        $order = \App\Models\ServiceOrder::create([
            'user_id' => auth()->id(),
            'service_name' => $data['service_name'],
            'requirements' => $data['requirements'],
            'order_number' => 'HA' . rand(1000, 9999),
            'status' => 'pending',
            'project_tech' => $data['project_tech'],
            'tech_stack' => $data['tech_stack'],
            'budget' => $data['budget'],
            'timeline' => $data['timeline'],
            'custom_responses' => $request->only(array_keys($request->except(['_token', 'service_name', 'requirements', 'requirements_file', 'project_tech', 'tech_stack', 'budget', 'timeline'])))
        ]);

        if ($request->hasFile('requirements_file')) {
            $files = [];
            foreach ($request->file('requirements_file') as $file) {
                $files[] = $file->store('service_requirements', 'public');
            }
            $order->requirements_file = json_encode($files);
            $order->save();
        }

        return redirect()->route('service.order.success', $order->id)->with('success', 'Your order has been submitted successfully!');
    }

    public function serviceOrderSuccess($id) {
        $order = \App\Models\ServiceOrder::where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.service_success', compact('order'));
    }

    public function trackServiceOrder($id) {
        $order = \App\Models\ServiceOrder::with('updates')->where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.user.tracking', compact('order'));
    }
}
