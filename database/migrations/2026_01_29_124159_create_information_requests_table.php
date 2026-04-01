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
        Schema::create('information_requests', function (Blueprint $table) {
            $table->id();
            
            // Pemohon
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            
            // Data Pribadi (jika tidak login atau PPID mengharuskan input detail)
            $table->string('kategori_pemohon')->default('Perorangan'); // Perorangan, Kelompok Orang, Badan Hukum
            $table->string('nik_no_identitas')->nullable();
            $table->string('nama_lengkap');
            $table->string('alamat');
            $table->string('email');
            $table->string('no_telp');
            $table->string('pekerjaan')->nullable();
            
            // Dokumen Pendukung
            $table->string('foto_ktp')->nullable(); // Upload KTP
            $table->string('dokumen_pendukung')->nullable(); // Upload Akta/Surat Kuasa untuk Badan Hukum
            
            // Permohonan
            $table->text('rincian_informasi');
            $table->text('tujuan_penggunaan');
            $table->enum('cara_memperoleh', ['Melihat/Membaca/Mendengarkan/Mencatat', 'Mendapatkan Salinan Hardcopy', 'Mendapatkan Salinan Softcopy'])->default('Mendapatkan Salinan Softcopy');
            $table->enum('cara_mendapatkan', ['Mengambil Langsung', 'Kurir/Pos', 'Faksimili', 'Email'])->default('Email');

            // Jika permohonan terkait dokumen spesifik secara langsung
            $table->foreignId('information_id')->nullable()->constrained('public_informations')->nullOnDelete();
            
            // Status PPID
            $table->enum('status', ['pending', 'diproses', 'approved', 'rejected'])->default('pending');
            $table->text('response_message')->nullable();
            $table->string('response_file')->nullable(); // File balasan PPID
            $table->timestamp('responded_at')->nullable();
            $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_requests');
    }
};
