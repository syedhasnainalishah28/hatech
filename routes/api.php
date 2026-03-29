<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\MarketplaceController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CmsController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\SitePageController;
use App\Http\Controllers\Api\Admin\PortfolioController;
use App\Http\Controllers\Api\Admin\TestimonialController;

// Public Auth
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);

// Public CMS (Page Sections)
Route::get('/cms/{page}', [CmsController::class, 'page']);

// Public Blog
Route::get('/blog/categories', [BlogController::class, 'categories']);
Route::get('/blog/posts', [BlogController::class, 'index']);
Route::get('/blog/posts/{slug}', [BlogController::class, 'show']);

// Public Marketplace
Route::get('/product-categories', [MarketplaceController::class, 'categories']);
Route::get('/products', [MarketplaceController::class, 'index']);
Route::get('/products/{slug}', [MarketplaceController::class, 'show']);

// Public Contact & Newsletter
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/newsletter/subscribe', [ContactController::class, 'subscribe']);

// Protected Routes (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Builder Routes (Commented out until Controller is created)
    /*
    Route::get('/builder/pages', [BuilderController::class, 'index']);
    Route::get('/builder/pages/{slug}', [BuilderController::class, 'show']);
    Route::post('/builder/pages/{slug}', [BuilderController::class, 'store']);
    */

    // Interactions
    Route::post('/blog/posts/{id}/comments', [BlogController::class, 'storeComment']);
    Route::post('/products/{id}/reviews', [MarketplaceController::class, 'storeReview']);

    // Buyer Orders
    Route::post('/orders', [MarketplaceController::class, 'placeOrder']);
    Route::get('/orders', [MarketplaceController::class, 'myOrders']);

    // Seller Routes
    Route::middleware('role:seller,admin')->prefix('seller')->group(function () {
        Route::post('/products', [MarketplaceController::class, 'sellerStore']);
        Route::put('/products/{id}', [MarketplaceController::class, 'sellerUpdate']);
        Route::get('/orders', [MarketplaceController::class, 'sellerOrders']);
    });

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // New Custom Admin API
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::apiResource('site-pages', SitePageController::class);
        Route::apiResource('portfolios', PortfolioController::class);
        Route::apiResource('testimonials', TestimonialController::class);

        // Product Management
        Route::get('/products', [\App\Http\Controllers\Api\Admin\ProductController::class, 'index']);
        Route::get('/product-categories', [\App\Http\Controllers\Api\Admin\ProductController::class, 'categories']);
        Route::post('/products', [\App\Http\Controllers\Api\Admin\ProductController::class, 'store']);
        Route::get('/products/{product}', [\App\Http\Controllers\Api\Admin\ProductController::class, 'show']);
        Route::put('/products/{id}', [\App\Http\Controllers\Api\Admin\ProductController::class, 'update']);
        Route::delete('/products/{id}', [\App\Http\Controllers\Api\Admin\ProductController::class, 'destroy']);

        // CMS
        Route::get('/cms', [CmsController::class, 'index']);
        Route::post('/cms', [CmsController::class, 'upsert']);
        Route::delete('/cms/{id}', [CmsController::class, 'destroy']);
        
        // Blog
        Route::get('/blog/posts', [\App\Http\Controllers\Api\Admin\BlogController::class, 'index']);
        Route::get('/blog/categories', [\App\Http\Controllers\Api\Admin\BlogController::class, 'categories']);
        Route::post('/blog/posts', [\App\Http\Controllers\Api\Admin\BlogController::class, 'store']);
        Route::get('/blog/posts/{blogPost}', [\App\Http\Controllers\Api\Admin\BlogController::class, 'show']);
        Route::put('/blog/posts/{id}', [\App\Http\Controllers\Api\Admin\BlogController::class, 'update']);
        Route::delete('/blog/posts/{id}', [\App\Http\Controllers\Api\Admin\BlogController::class, 'destroy']);
        
        // Contacts
        Route::get('/contacts', [ContactController::class, 'index']);
        Route::put('/contacts/{id}/read', [ContactController::class, 'markRead']);
        
        // Orders
        Route::put('/orders/{id}/status', [MarketplaceController::class, 'adminUpdateOrderStatus']);
    });
});
