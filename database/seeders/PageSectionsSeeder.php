<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageSection;

class PageSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            // --- HOME PAGE (Hero Section) ---
            ['page' => 'home', 'section_key' => 'hero_tagline', 'type' => 'text', 'value' => 'NEXT GEN DIGITAL AGENCY'],
            ['page' => 'home', 'section_key' => 'hero_title_line1', 'type' => 'text', 'value' => 'BUILD YOUR'],
            ['page' => 'home', 'section_key' => 'hero_title_line2', 'type' => 'text', 'value' => 'DIGITAL EMPIRE'],
            ['page' => 'home', 'section_key' => 'hero_description', 'type' => 'text', 'value' => 'We don\'t follow trends, we set them. HA Tech bridges the gap between raw innovation and enterprise-grade execution.'],
            ['page' => 'home', 'section_key' => 'hero_btn_primary', 'type' => 'text', 'value' => 'START YOUR JOURNEY'],
            ['page' => 'home', 'section_key' => 'hero_btn_secondary', 'type' => 'text', 'value' => 'VIEW OUR WORK'],

            // --- ALL PAGES (Navbar / Global) ---
            ['page' => 'global', 'section_key' => 'nav_link_services', 'type' => 'text', 'value' => 'Services'],
            ['page' => 'global', 'section_key' => 'nav_link_work', 'type' => 'text', 'value' => 'Work'],
            ['page' => 'global', 'section_key' => 'nav_link_about', 'type' => 'text', 'value' => 'About'],
            ['page' => 'global', 'section_key' => 'nav_link_contact', 'type' => 'text', 'value' => 'Contact'],
            ['page' => 'global', 'section_key' => 'nav_btn_signin', 'type' => 'text', 'value' => 'Sign In'],

            // --- HOME PAGE (Services Section) ---
            ['page' => 'home', 'section_key' => 'services_tagline', 'type' => 'text', 'value' => 'OUR EXPERTISE'],
            ['page' => 'home', 'section_key' => 'services_title', 'type' => 'text', 'value' => 'Services that scale'],
            ['page' => 'home', 'section_key' => 'services_description', 'type' => 'text', 'value' => 'From strategy to execution, we deliver end-to-end digital solutions that drive measurable growth.'],

            // --- HOME PAGE (Stats Section) ---
            ['page' => 'home', 'section_key' => 'stats_tagline', 'type' => 'text', 'value' => 'OUR IMPACT'],
            ['page' => 'home', 'section_key' => 'stats_title', 'type' => 'text', 'value' => 'Numbers that prove our excellence'],

            // --- HOME PAGE (Testimonials Section) ---
            ['page' => 'home', 'section_key' => 'testimonials_tagline', 'type' => 'text', 'value' => 'CLIENT SUCCESS'],
            ['page' => 'home', 'section_key' => 'testimonials_title', 'type' => 'text', 'value' => 'What our partners say'],
            ['page' => 'home', 'section_key' => 'testimonials_description', 'type' => 'text', 'value' => 'Don\'t just take our word for it. Here is what leading brands have to say about working with us.'],

            // --- HOME PAGE (CTA Section) ---
            ['page' => 'home', 'section_key' => 'cta_title', 'type' => 'text', 'value' => 'Ready to transform your business?'],
            ['page' => 'home', 'section_key' => 'cta_description', 'type' => 'text', 'value' => 'Join the forward-thinking companies that trust HA Tech to build their digital future.'],
            ['page' => 'home', 'section_key' => 'cta_btn_primary', 'type' => 'text', 'value' => 'START A PROJECT'],
            ['page' => 'home', 'section_key' => 'cta_btn_secondary', 'type' => 'text', 'value' => 'SCHEDULE A CALL'],
        ];

        foreach ($sections as $section) {
            PageSection::updateOrCreate(
                ['page' => $section['page'], 'section_key' => $section['section_key']],
                ['type' => $section['type'], 'value' => $section['value'], 'active' => true]
            );
        }
    }
}
