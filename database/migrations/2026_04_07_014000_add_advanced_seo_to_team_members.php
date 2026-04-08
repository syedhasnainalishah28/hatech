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
        Schema::table('team_members', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name')->nullable();
            $table->longText('bio')->after('role')->nullable();
            $table->text('expertise')->after('bio')->nullable();
            $table->text('achievements')->after('expertise')->nullable();
            $table->string('meta_title')->after('is_active')->nullable();
            $table->text('meta_description')->after('meta_title')->nullable();
            $table->string('meta_keywords')->after('meta_description')->nullable();
            $table->text('schema_markup')->after('meta_keywords')->nullable();
            $table->string('instagram_url')->after('twitter_url')->nullable();
            $table->string('github_url')->after('instagram_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'bio', 'expertise', 'achievements',
                'meta_title', 'meta_description', 'meta_keywords',
                'schema_markup', 'instagram_url', 'github_url'
            ]);
        });
    }
};
