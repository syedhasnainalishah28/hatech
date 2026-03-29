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
        Schema::table('service_orders', function (Blueprint $table) {
            $table->string('project_tech')->nullable(); // CMS, Custom
            $table->string('tech_stack')->nullable(); // WordPress, Shopify, React, Laravel, etc.
            $table->string('budget')->nullable();
            $table->string('timeline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_orders', function (Blueprint $table) {
            $table->dropColumn(['project_tech', 'tech_stack', 'budget', 'timeline']);
        });
    }
};
