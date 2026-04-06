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
        Schema::table('blog_posts', function (Blueprint $blade) {
            $blade->boolean('sidebar_left_show')->default(true);
            $blade->boolean('sidebar_right_show')->default(true);
            $blade->string('sidebar_left_type')->default('standard'); // standard, custom
            $blade->string('sidebar_right_type')->default('standard'); // standard, custom
            $blade->text('sidebar_left_content')->nullable();
            $blade->text('sidebar_right_content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $blade) {
            $blade->dropColumn(['sidebar_left_show', 'sidebar_right_show', 'sidebar_left_type', 'sidebar_right_type', 'sidebar_left_content', 'sidebar_right_content']);
        });
    }
};
