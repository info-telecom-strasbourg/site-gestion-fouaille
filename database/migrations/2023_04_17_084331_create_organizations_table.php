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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('website_link', 50)->nullable();
            $table->string('facebook_link', 50)->nullable();
            $table->string('twitter_link', 50)->nullable();
            $table->string('instagram_link', 50)->nullable();
            $table->string('discord_link', 50)->nullable();
            $table->string('logo_link', 50)->nullable();
            $table->boolean('association')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
