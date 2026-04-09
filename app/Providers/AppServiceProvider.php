<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Dynamic Development Mode
        if (!app()->runningInConsole() && \Schema::hasTable('site_settings')) {
            $devMode = \App\Models\SiteSetting::get('developer_mode', false);
            
            // If Dev Mode is ON, enable debug. If OFF, force it OFF.
            config(['app.debug' => $devMode]);
        }

        // 2. Maintenance Mode Secret Bypass helper (hasnain-access)
        // This was already handled by Artisan::call('down', ['--secret' => '...'])
    }
}
