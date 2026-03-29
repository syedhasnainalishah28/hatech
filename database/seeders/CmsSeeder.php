<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use App\Models\Testimonial;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // Portfolio items
        Portfolio::create([
            'title' => 'CYBER-CORE ERP',
            'description' => 'Next-gen operational framework for global supply chain logistics.',
            'category' => 'Enterprise',
            'year' => '2024',
            'image_path' => 'portfolio/erp.png',
            'order' => 1
        ]);

        Portfolio::create([
            'title' => 'NEXA-BRAND OS',
            'description' => 'Autonomous brand identity system driven by generative intelligence.',
            'category' => 'AI & Design',
            'year' => '2023',
            'image_path' => 'portfolio/branding.png',
            'order' => 2
        ]);

        Portfolio::create([
            'title' => 'SWIFT-FINANCE',
            'description' => 'Ultra-low latency financial architecture for decentralized markets.',
            'category' => 'Fintech',
            'year' => '2024',
            'image_path' => 'portfolio/fintech.png',
            'order' => 3
        ]);

        // Testimonials
        Testimonial::create([
            'name' => 'Sarah Jenkins',
            'role' => 'CTO',
            'company' => 'LuxeOps Global',
            'content' => 'HA Tech didn\'t just build our software; they architected our future. The precision in their execution is unparalleled in the modern tech landscape.',
            'rating' => 5
        ]);

        Testimonial::create([
            'name' => 'Marcus Thorne',
            'role' => 'Founder',
            'company' => 'Aura Labs',
            'content' => 'The luxury aesthetic combined with high-end performance made HA Tech the only choice for our blockchain integration projects. They are simply the best.',
            'rating' => 5
        ]);

        Testimonial::create([
            'name' => 'Elena Rodriguez',
            'role' => 'VP of Product',
            'company' => 'SwiftCore Fintech',
            'content' => 'Elite workflow, record delivery times, and a product that feels like it’s from 2030. HA Tech is the definition of digital excellence.',
            'rating' => 5
        ]);
    }
}
