<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Admins Table (Separate from Users)
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('two_factor_code')->nullable();
            $table->dateTime('two_factor_expires_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Activity Logs (Hardened Audit Trail)
        Schema::create('administrative_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('action'); // e.g., login_attempt, file_upload_blocked, settings_changed
            $table->text('description')->nullable();
            $table->string('ip_address', 45);
            $table->string('user_agent');
            $table->string('device_type')->nullable(); // Mobile, Desktop, Tablet
            $table->string('os_name')->nullable();
            $table->string('browser_name')->nullable();
            $table->json('payload')->nullable(); // Stores related data
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
        });

        // 3. Site Settings (Dev Mode Toggle)
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, boolean, json
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // Seed default developer mode
        \DB::table('site_settings')->insert([
            'key' => 'developer_mode',
            'value' => '0',
            'type' => 'boolean',
            'group' => 'system',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('administrative_logs');
        Schema::dropIfExists('admins');
    }
};
