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
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->enum('platform', ['facebook', 'x', 'instagram', 'tiktok', 'youtube', 'threads'])->nullable(false);  // Facebook, Twitter, Instagram, dll
            $table->string('url', 255);     // Link ke profil/page
            $table->string('icon')->nullable(); // Icon fontawesome / path gambar
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media');
    }
};
