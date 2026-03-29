<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page'); // home, about, services, contact, etc.
            $table->string('section_key'); // hero_title, hero_subtitle, stats, etc.
            $table->string('type')->default('text'); // text, richtext, image, list, json
            $table->longText('value')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->unique(['page', 'section_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
