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
        Schema::table('portfolios', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->longText('content')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropColumn(['slug', 'content']);
        });
    }
};
