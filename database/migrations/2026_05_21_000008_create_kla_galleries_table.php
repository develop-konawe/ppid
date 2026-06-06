<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kla_galleries', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['photo', 'video'])->default('photo');
            $table->string('caption')->nullable();
            $table->text('description')->nullable();
            $table->string('media_url')->nullable()->comment('URL untuk video');
            $table->string('media_path')->nullable()->comment('Path lokal untuk foto');
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kla_galleries');
    }
};
