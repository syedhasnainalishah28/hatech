<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'syedhasnainalishah28@gmail.com'],
            [
                'name' => 'Hasnain Shah',
                'password' => Hash::make('Security@HA-Tech-3192112004'), // 12+ chars as requested
                'is_active' => true,
            ]
        );
    }
}
