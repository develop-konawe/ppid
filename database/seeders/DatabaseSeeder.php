<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OpdSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            SocialMediaSeeder::class,
            PengaturanSeeder::class,
            GallerySeeder::class,
            CarouselSeeder::class,
            CategorySeeder::class,
            UserRoleSeeder::class,
            RegulationSeeder::class,
            PageSeeder::class,
            FaqSeeder::class,
            InformationCategorySeeder::class,
            PublicInformationSeeder::class,
        ]);

        // Seed News
        DB::table('news')->insert([
            [
                'category_id' => 1,
                'title' => 'Luncurkan Aplikasi PPID Baru',
                'slug' => Str::slug('Luncurkan Aplikasi PPID Baru'),
                'content' => 'Isi konten berita tentang peluncuran aplikasi...',
                'is_featured' => true,
                'source_type' => 'ppid_utama',
                'opd_id' => 1,
                'created_by' => 1,
                'created_at' => now(),
            ]
        ]);

        // Seed Announcements
        DB::table('announcements')->insert([
            [
                'category_id' => 2,
                'title' => 'Pengumuman Seleksi CPNS 2025',
                'slug' => Str::slug('Pengumuman Seleksi CPNS 2025'),
                'description' => 'Pendaftaran dibuka mulai besok...',
                'is_active' => true,
                'published_at' => now(),
                'source_type' => 'ppid_pelaksana',
                'opd_id' => 2,
                'created_by' => 1,
                'created_at' => now(),
            ]
        ]);

        // Seed Pages
        DB::table('pages')->insert([
            [
                'title' => 'Profil PPID',
                'slug' => 'profil-ppid',
                'content' => 'Halaman ini berisi struktur organisasi PPID.',
                'is_active' => true,
                'created_at' => now(),
            ]
        ]);

    }

    // untuk memanggil 1 seeder saja, gunakan command berikut di terminal:
    // php artisan db:seed --class=MenuSeeder
}
