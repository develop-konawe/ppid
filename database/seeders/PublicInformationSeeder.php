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
            'file_path' => 'ppid/laporan-keuangan-dinkes-2024.pdf',
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
    }
}
