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
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_name');
            $table->string('subject');
            $table->string('logo_path')->nullable();
            $table->string('brand_name')->default('HA Tech');
            $table->string('tagline')->default('GEN Z EVOLUTION');
            $table->text('content'); // Base template content with placeholders
            $table->string('contact_phone')->default('+92 325 9220167');
            $table->string('contact_email')->default('contact@hatechservices.com.pk');
            $table->string('website_url')->default('www.hatechservices.com.pk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
