<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/services', [FrontendController::class, 'services']);
Route::get('/work', [FrontendController::class, 'work']);
Route::get('/work/{id}', [FrontendController::class, 'portfolioShow'])->name('portfolio.show');
Route::get('/blogs', [FrontendController::class, 'blogs'])->name('blogs');
Route::get('/blogs/{slug}', [FrontendController::class, 'blogSingle'])->name('blog.single');
Route::get('/sitemap.xml', [FrontendController::class, 'sitemap'])->name('sitemap');

Route::get('/about', [FrontendController::class, 'about']);
Route::get('/team', [FrontendController::class, 'team']);
Route::get('/about/founder', [FrontendController::class, 'founder']);
Route::get('/about/ceo', [FrontendController::class, 'ceo']);
Route::get('/products', [FrontendController::class, 'products']);
Route::get('/marketplace', [FrontendController::class, 'marketplace']);
Route::get('/contact', [FrontendController::class, 'contact']);
Route::post('/contact', [FrontendController::class, 'postContact']);
Route::post('/testimonials/submit', [FrontendController::class, 'submitTestimonial'])->name('testimonials.submit');

Route::get('/login', [FrontendController::class, 'login'])->name('login');
Route::post('/login', [FrontendController::class, 'postLogin']);
Route::get('/signup', [FrontendController::class, 'signup'])->name('signup');
Route::post('/signup', [FrontendController::class, 'postSignup']);
Route::post('/logout', [FrontendController::class, 'logout'])->name('logout');

// Social Auth
use App\Http\Controllers\SocialAuthController;
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [FrontendController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user/orders', [FrontendController::class, 'userOrders'])->name('user.orders');
    Route::get('/user/downloads', [FrontendController::class, 'userDownloads'])->name('user.downloads');
    Route::get('/user/settings', [FrontendController::class, 'userSettings'])->name('user.settings');
    Route::post('/user/settings', [FrontendController::class, 'userSettingsUpdate'])->name('user.settings.update');

    // Service Orders
    Route::post('/services/order', [FrontendController::class, 'postServiceOrder'])->name('service.order.submit');
    Route::get('/services/order-success/{id}', [FrontendController::class, 'serviceOrderSuccess'])->name('service.order.success');
    Route::get('/dashboard/track/{id}', [FrontendController::class, 'trackServiceOrder'])->name('service.order.track');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/maintenance/toggle', [AdminController::class, 'toggleMaintenance'])->name('admin.maintenance.toggle');
    
    // Portfolios
    Route::get('/portfolios', [AdminController::class, 'portfolios'])->name('admin.portfolios');
    Route::get('/portfolios/create', [AdminController::class, 'portfolioCreate'])->name('admin.portfolios.create');
    Route::post('/portfolios', [AdminController::class, 'portfolioStore'])->name('admin.portfolios.store');
    Route::get('/portfolios/{id}/edit', [AdminController::class, 'portfolioEdit'])->name('admin.portfolios.edit');
    Route::post('/portfolios/{id}', [AdminController::class, 'portfolioUpdate'])->name('admin.portfolios.update');
    Route::delete('/portfolios/{id}', [AdminController::class, 'portfolioDestroy'])->name('admin.portfolios.destroy');

    // Testimonials
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('admin.testimonials');
    Route::get('/testimonials/create', [AdminController::class, 'testimonialCreate'])->name('admin.testimonials.create');
    Route::post('/testimonials', [AdminController::class, 'testimonialStore'])->name('admin.testimonials.store');
    Route::get('/testimonials/{id}/edit', [AdminController::class, 'testimonialEdit'])->name('admin.testimonials.edit');
    Route::post('/testimonials/{id}', [AdminController::class, 'testimonialUpdate'])->name('admin.testimonials.update');
    Route::delete('/testimonials/{id}', [AdminController::class, 'testimonialDestroy'])->name('admin.testimonials.destroy');
    Route::post('/testimonials/{id}/approve', [AdminController::class, 'testimonialApprove'])->name('admin.testimonials.approve');

    // Products & Marketplace
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'productCreate'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'productStore'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'productEdit'])->name('admin.products.edit');
    Route::post('/products/{id}', [AdminController::class, 'productUpdate'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'productDestroy'])->name('admin.products.destroy');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    // Pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('admin.pages');
    Route::get('/pages/create', [AdminController::class, 'pageCreate'])->name('admin.pages.create');
    Route::post('/pages', [AdminController::class, 'pageStore'])->name('admin.pages.store');
    Route::get('/pages/{id}/edit', [AdminController::class, 'pageEdit'])->name('admin.pages.edit');
    Route::post('/pages/{id}', [AdminController::class, 'pageUpdate'])->name('admin.pages.update');
    Route::delete('/pages/{id}', [AdminController::class, 'pageDestroy'])->name('admin.pages.destroy');

    // Admin Service Orders
    Route::get('/service-orders', [AdminController::class, 'serviceOrders'])->name('admin.service_orders');
    Route::get('/service-orders/{id}', [AdminController::class, 'serviceOrderShow'])->name('admin.service_orders.show');
    Route::post('/service-orders/{id}/update', [AdminController::class, 'serviceOrderUpdate'])->name('admin.service_orders.update');

    // Email Marketing
    Route::get('/email-templates', [AdminController::class, 'emailTemplates'])->name('admin.email_templates');
    Route::get('/email-templates/create', [AdminController::class, 'emailTemplateCreate'])->name('admin.email_templates.create');
    Route::post('/email-templates', [AdminController::class, 'emailTemplateStore'])->name('admin.email_templates.store');
    Route::get('/email-templates/{id}/edit', [AdminController::class, 'emailTemplateEdit'])->name('admin.email_templates.edit');
    Route::post('/email-templates/{id}', [AdminController::class, 'emailTemplateUpdate'])->name('admin.email_templates.update');
    Route::delete('/email-templates/{id}', [AdminController::class, 'emailTemplateDestroy'])->name('admin.email_templates.destroy');

    Route::get('/emails/send', [AdminController::class, 'sendEmailForm'])->name('admin.emails.send');
    Route::post('/emails/send', [AdminController::class, 'sendEmail'])->name('admin.emails.dispatch');

    // Services Catalog
    Route::get('/services-catalog', [AdminController::class, 'services'])->name('admin.services');
    Route::get('/services-catalog/create', [AdminController::class, 'serviceCreate'])->name('admin.services.create');
    Route::post('/services-catalog', [AdminController::class, 'serviceStore'])->name('admin.services.store');
    Route::get('/services-catalog/{id}/edit', [AdminController::class, 'serviceEdit'])->name('admin.services.edit');
    Route::post('/services-catalog/{id}', [AdminController::class, 'serviceUpdate'])->name('admin.services.update');
    Route::delete('/services-catalog/{id}', [AdminController::class, 'serviceDestroy'])->name('admin.services.destroy');

    // Team Members
    Route::get('/team', [AdminController::class, 'teamIndex'])->name('admin.team');
    Route::get('/team/create', [AdminController::class, 'teamCreate'])->name('admin.team.create');
    Route::post('/team', [AdminController::class, 'teamStore'])->name('admin.team.store');
    Route::get('/team/{id}/edit', [AdminController::class, 'teamEdit'])->name('admin.team.edit');
    Route::post('/team/{id}', [AdminController::class, 'teamUpdate'])->name('admin.team.update');
    Route::delete('/team/{id}', [AdminController::class, 'teamDestroy'])->name('admin.team.destroy');

    // SEO Blog Module
    Route::get('/blog/categories', [\App\Http\Controllers\AdminBlogController::class, 'categoriesIndex'])->name('admin.blog.categories');
    Route::post('/blog/categories', [\App\Http\Controllers\AdminBlogController::class, 'categoriesStore'])->name('admin.blog.categories.store');
    Route::post('/blog/categories/{id}', [\App\Http\Controllers\AdminBlogController::class, 'categoriesUpdate'])->name('admin.blog.categories.update');
    Route::delete('/blog/categories/{id}', [\App\Http\Controllers\AdminBlogController::class, 'categoriesDestroy'])->name('admin.blog.categories.destroy');

    Route::get('/blog/posts', [\App\Http\Controllers\AdminBlogController::class, 'postsIndex'])->name('admin.blog.posts');
    Route::get('/blog/posts/create', [\App\Http\Controllers\AdminBlogController::class, 'postsCreate'])->name('admin.blog.posts.create');
    Route::post('/blog/posts', [\App\Http\Controllers\AdminBlogController::class, 'postsStore'])->name('admin.blog.posts.store');
    Route::get('/blog/posts/{id}/edit', [\App\Http\Controllers\AdminBlogController::class, 'postsEdit'])->name('admin.blog.posts.edit');
    Route::post('/blog/posts/{id}', [\App\Http\Controllers\AdminBlogController::class, 'postsUpdate'])->name('admin.blog.posts.update');
    Route::delete('/blog/posts/{id}', [\App\Http\Controllers\AdminBlogController::class, 'postsDestroy'])->name('admin.blog.posts.destroy');
});

// TEMPORARY: Database Migration Utility for Shared Hosting
// Visit: /run-migrations and then DELETE THIS ROUTE for security.
Route::get('/run-migrations', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return "<h1>HA Tech | Migration Center</h1><p style='color: green;'>Database updated successfully! ✅</p><p>Check your site now. <b>Don't forget to delete this route from web.php!</b></p>";
    } catch (\Exception $e) {
        return "<h1>Migration Error</h1><pre>" . $e->getMessage() . "</pre>";
    }
});
