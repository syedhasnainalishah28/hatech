<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['icon' => 'code', 'name' => 'Web Development', 'description' => 'Custom websites built with modern frameworks like React, Next.js, and Vue.', 'gradient_class' => 'from-[#d4a574] to-[#e8b44a]'],
            ['icon' => 'smartphone', 'name' => 'Mobile App Development', 'description' => 'Native and cross-platform mobile applications for iOS and Android.', 'gradient_class' => 'from-[#e8b44a] to-[#c49a6b]'],
            ['icon' => 'palette', 'name' => 'UI/UX Design', 'description' => 'Beautiful, intuitive designs that enhance user experience and drive conversions.', 'gradient_class' => 'from-[#c49a6b] to-[#8b6f47]'],
            ['icon' => 'rocket', 'name' => 'Digital Marketing', 'description' => 'Data-driven marketing strategies that increase your online presence.', 'gradient_class' => 'from-[#8b6f47] to-[#b8860b]'],
            ['icon' => 'cloud', 'name' => 'Cloud Solutions', 'description' => 'Scalable cloud infrastructure and migration services.', 'gradient_class' => 'from-[#b8860b] to-[#daa520]'],
            ['icon' => 'database', 'name' => 'Backend Development', 'description' => 'Robust and scalable backend systems with Node.js and Python.', 'gradient_class' => 'from-[#daa520] to-[#d4a574]']
        ];

        foreach ($services as $svc) {
            \App\Models\Service::updateOrCreate(
                ['name' => $svc['name']],
                [
                    'description' => $svc['description'],
                    'icon' => $svc['icon'],
                    'gradient_class' => $svc['gradient_class'],
                    'file_limit' => 5,
                    'custom_fields' => [] // Admin can add these later
                ]
            );
        }
    }
}
