<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InformationCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Profil',
            'Program dan Kegiatan',
            'Laporan Keuangan',
            'Laporan Kinerja',
            'SOP Layanan',
            'Pengumuman',
        ];

        foreach ($categories as $category) {
            DB::table('information_categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
