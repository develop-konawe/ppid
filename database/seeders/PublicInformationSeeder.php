<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicInformationSeeder extends Seeder
{
    public function run(): void
    {
        // ambil contoh id
        $opdId = DB::table('opds')->value('id');
        $userId = DB::table('users')->value('id');

        $profilCategory = DB::table('information_categories')
            ->where('slug', 'profil')
            ->value('id');

        $keuanganCategory = DB::table('information_categories')
            ->where('slug', 'laporan-keuangan')
            ->value('id');

        // =========================
        // INFORMASI BERKALA - PROFIL
        // =========================
        DB::table('public_informations')->insert([
            'title' => 'Profil Dinas Kesehatan',
            'description' => 'Profil resmi Dinas Kesehatan',
            'information_type' => 'berkala',
            'report_level' => null,
            'category_id' => $profilCategory,
            'opd_id' => $opdId,
            'year' => null,
            'file_path' => 'ppid/profil-dinkes.pdf',
            'status' => 'published',
            'created_by' => $userId,
            'approved_by' => $userId,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('public_informations')->insert([
            [
                'title' => 'Laporan Keuangan Tahunan 2024',
                'description' => 'Laporan realisasi anggaran tahunan OPD.',
                'information_type' => 'berkala',
                'report_level' => 'opd',
                'category_id' => 2, // Laporan Keuangan
                'opd_id' => $opdId,
                'year' => 2024,
                'file_path' => 'https://www.ppid.bombanakab.go.id/upload/regular_information/1756267324.pdf',
                'file_type' => 'pdf',
                'status' => 'published',
                'created_by' => $userId,
                'published_at' => now(),
                'created_at' => now(),
            ],
            // 2. Contoh Informasi Dikecualikan (Draft/Review biasanya)
            [
                'title' => 'Data Rahasia Identitas Saksi',
                'description' => 'Data yang tidak dapat dibuka ke publik berdasarkan UU.',
                'information_type' => 'dikecualikan',
                'report_level' => 'opd',
                'category_id' => $opdId,
                'opd_id' => 1,
                'year' => 2024,
                'file_path' => null,
                'file_type' => null,
                'status' => 'published',
                'created_by' => $userId,
                'published_at' => now(),
                'created_at' => now(),
            ]
        ]);

        // =========================
        // LAPORAN KEUANGAN OPD
        // =========================
        DB::table('public_informations')->insert([
            'title' => 'Laporan Keuangan Dinas Kesehatan 2024',
            'description' => 'Laporan keuangan tahunan',
            'information_type' => 'berkala',
            'report_level' => 'opd',
            'category_id' => $keuanganCategory,
            'opd_id' => $opdId,
            'year' => 2024,
            'file_path' => 'https://www.ppid.bombanakab.go.id/upload/regular_information/1756267324.pdf',
            'status' => 'published',
            'created_by' => $userId,
            'approved_by' => $userId,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // =========================
        // INFORMASI DIKECUALIKAN
        // =========================
        $excludedId = DB::table('public_informations')->insertGetId([
            'title' => 'Dokumen Investigasi Internal',
            'description' => 'Dokumen bersifat rahasia',
            'information_type' => 'dikecualikan',
            'report_level' => null,
            'category_id' => $keuanganCategory,
            'opd_id' => $opdId,
            'year' => 2024,
            'file_path' => null,
            'status' => 'published',
            'created_by' => $userId,
            'approved_by' => $userId,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // detail pengecualian
        DB::table('information_exceptions')->insert([
            'public_information_id' => $excludedId,
            'exception_reason' => 'Menghambat proses penegakan hukum',
            'legal_basis' => 'UU KIP Pasal 17 huruf a',
            'valid_until' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // =========================
        // INFORMASI SETIAP SAAT
        // =========================
        DB::table('public_informations')->insert([
            [
                'title' => 'Peraturan Bupati Konawe No. 15 Tahun 2026',
                'description' => 'Tentang Standar Pelayanan Publik. Dokumen ini mengatur tata cara standar pelayanan untuk masyarakat Kabupaten Konawe.',
                'information_type' => 'setiap_saat',
                'report_level' => 'konsolidasi',
                'category_id' => 1, // Anggap 1 adalah Peraturan
                'opd_id' => $opdId,
                'year' => 2026,
                'file_url' => 'https://jdih.konawekab.go.id/dokumen/perbup-15-2026.pdf',
                'status' => 'published',
                'created_by' => $userId,
                'published_at' => now(),
                'created_at' => now(),
            ],
            [
                'title' => 'Profil Kabupaten Konawe 2026',
                'description' => 'Buku Profil Kabupaten memuat data geografis, demografis, sosial ekonomi, dan potensi daerah.',
                'information_type' => 'setiap_saat',
                'report_level' => 'konsolidasi',
                'category_id' => 2, 
                'opd_id' => $opdId,
                'year' => 2026,
                'file_url' => 'https://ppid.konawekab.go.id/upload/profil-konawe-2026.pdf',
                'status' => 'published',
                'created_by' => $userId,
                'published_at' => now()->subDays(5),
                'created_at' => now()->subDays(5),
            ]
        ]);

        // =========================
        // INFORMASI SERTA MERTA
        // =========================
        DB::table('public_informations')->insert([
            [
                'title' => 'Peringatan Dini Cuaca Ekstrem (Banjir Bandang)',
                'description' => 'Himbauan kepada masyarakat di bantaran sungai Konaweeha untuk waspada terhadap potensi banjir bandang curah hujan tinggi selama seminggu ke depan.',
                'information_type' => 'serta_merta',
                'report_level' => 'konsolidasi',
                'category_id' => 3, // Anggap 3 adalah Peringatan Bencana
                'opd_id' => $opdId,
                'year' => 2026,
                'file_url' => null,
                'status' => 'published',
                'created_by' => $userId,
                'published_at' => now(),
                'created_at' => now(),
            ],
            [
                'title' => 'Pengalihan Arus Lalu Lintas Trans Sulawesi',
                'description' => 'Informasi pengalihan arus akibat adanya perbaikan jembatan utama di jalan poros Trans Sulawesi ruas Unaaha selama 14 hari kerja.',
                'information_type' => 'serta_merta',
                'report_level' => 'konsolidasi',
                'category_id' => 4,
                'opd_id' => $opdId,
                'year' => 2026,
                'file_url' => 'https://dishub.konawekab.go.id/pengalihan-arus.jpg',
                'status' => 'published',
                'created_by' => $userId,
                'published_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
            ]
        ]);
    }
}
