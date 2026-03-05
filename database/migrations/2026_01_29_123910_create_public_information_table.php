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
        Schema::create('public_informations', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            // Jenis Informasi Publik (UU KIP)
            $table->enum('information_type', [
                'berkala',
                'setiap_saat',
                'serta_merta',
                'dikecualikan'
            ]);

            // Untuk laporan keuangan, dll
            $table->enum('report_level', [
                'opd',
                'konsolidasi'
            ])->nullable();

            // Relasi ke kategori
            $table->foreignId('category_id')
                ->constrained('information_categories');

            // 🔑 RELASI KE OPD (PPID Pelaksana)
            $table->foreignId('opd_id')
                ->constrained('opds');

            $table->year('year')->nullable();

            // File
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable();
            $table->integer('file_size')->nullable();

            // Status publikasi
            $table->enum('status', [
                'draft',
                'review',
                'published',
                'rejected'
            ])->default('draft');

            // Audit trail
            $table->foreignId('created_by')->nullable();
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_information');
    }
};
