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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
//            type ENUM('photo','video'),
//  caption VARCHAR(255),
//  media_url VARCHAR(255),
//  gallery_group VARCHAR(100)
            $table->enum('type', ['photo', 'video']);
            $table->string('caption')->nullable();
            $table->string('media_url');
            $table->string('gallery_group')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
