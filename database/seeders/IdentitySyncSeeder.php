<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SitePage;
use App\Models\TeamMember;

class IdentitySyncSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Sync Founder Page
        SitePage::updateOrCreate(
            ['slug' => 'founder'],
            [
                'name' => 'Hasnain Shah',
                'components_json' => [
                    "designation" => "Founder & Architect of Gen Z Digital Evolution.",
                    "biography" => "Testing",
                    "stat1_label" => "Innovations Produced",
                    "stat1_value" => "25",
                    "stat2_label" => "Digital Transformations",
                    "stat2_value" => "12",
                    "stat3_label" => "Years of Experience",
                    "stat3_value" => "8+",
                    "skills" => [],
                    "timeline" => [],
                    "honor" => null,
                    "quote" => null,
                    "gallery" => []
                ],
                'is_published' => true,
                'is_active' => true,
            ]
        );

        // 2. Sync CEO Page
        SitePage::updateOrCreate(
            ['slug' => 'ceo'],
            [
                'name' => 'Syed Ahmar Ali',
                'components_json' => [
                    "designation" => "CEO",
                    "biography" => "Testing",
                    "linkedin" => null,
                    "twitter" => null,
                    "email" => null,
                    "stat1_label" => null,
                    "stat1_value" => null,
                    "stat2_label" => null,
                    "stat2_value" => null
                ],
                'is_published' => true,
                'is_active' => true,
            ]
        );

        // 3. Sync Team Members
        TeamMember::updateOrCreate(
            ['email' => '#'], // Use email or another unique field for Hasnain
            [
                'name' => 'Hasnain',
                'role' => 'CEO',
                'image_path' => 'team/zbfcHhJ9F5kyK0UAgmhjvuGWxFnkdq2HMzQTxCpG.jpg',
                'is_active' => true,
                'linkedin_url' => '#',
                'twitter_url' => '#',
                'gradient' => 'from-[#4a1520] to-[#d4a574]'
            ]
        );
    }
}
