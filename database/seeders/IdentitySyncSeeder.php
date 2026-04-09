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

        // 4. Sync About Page (Generic)
        SitePage::updateOrCreate(
            ['slug' => 'about'],
            [
                'name' => 'About Our Evolution',
                'components_json' => [
                    "hero_title" => "Shaping the Digital Future",
                    "hero_subtitle" => "We are a team of visionaries, designers, and engineers dedicated to building extraordinary digital experiences.",
                    "story_title" => "Our Story",
                    "story_content" => "HA Tech was born from a vision to revolutionize the digital landscape for the new generation. We're not just another IT agency - we're a movement, a platform, and a community dedicated to pushing the boundaries of what's possible in the digital world.",
                    "mission_desc" => "To empower brands with cutting-edge technology and creative excellence.",
                    "vision_desc" => "To be the global leader in digital transformation and innovation.",
                    "excellence_desc" => "Committed to delivering premium quality every time"
                ],
                'is_published' => true,
                'is_active' => true,
            ]
        );
    }
}
