<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SitePage;

class SitePagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['name' => 'Home',              'slug' => 'home',           'is_active' => true],
            ['name' => 'Services',          'slug' => 'services',       'is_active' => true],
            ['name' => 'Portfolio / Work',  'slug' => 'portfolio',      'is_active' => true],
            ['name' => 'About Us',          'slug' => 'about',          'is_active' => true],
            ['name' => 'About - Founder',   'slug' => 'about-founder',  'is_active' => true],
            ['name' => 'About - CEO',       'slug' => 'about-ceo',      'is_active' => true],
            ['name' => 'About - Company',   'slug' => 'about-company',  'is_active' => true],
            ['name' => 'Blog',              'slug' => 'blog',           'is_active' => true],
            ['name' => 'Marketplace',       'slug' => 'marketplace',    'is_active' => true],
            ['name' => 'Careers',           'slug' => 'careers',        'is_active' => true],
            ['name' => 'Contact',           'slug' => 'contact',        'is_active' => true],
            ['name' => 'Team',              'slug' => 'team',           'is_active' => true],
            ['name' => 'Login',             'slug' => 'login',          'is_active' => true],
            ['name' => 'Sign Up',           'slug' => 'signup',         'is_active' => true],
        ];

        foreach ($pages as $page) {
            SitePage::firstOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }

        $this->command->info('Site pages seeded: ' . SitePage::count() . ' total.');
    }
}
