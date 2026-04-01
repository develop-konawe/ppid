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

        // Seed Information Requests
        DB::table('information_requests')->insert([
            [
                'kategori_pemohon' => 'Perorangan',
                'nama_lengkap' => 'Budi Santoso',
                'nik_no_identitas' => '7402010101900001',
                'email' => 'budi.santoso@example.com',
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Poros Unaaha, Kecamatan Wawotobi, Konawe',
                'pekerjaan' => 'Wiraswasta',
                'rincian_informasi' => 'Meminta data salinan belanja anggaran dinas kesehatan tahun 2024 untuk kebutuhan penelitian.',
                'tujuan_penggunaan' => 'Penelitian Akademis',
                'cara_memperoleh' => 'Mendapatkan Salinan Softcopy',
                'cara_mendapatkan' => 'Email',
                'status' => 'pending',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'kategori_pemohon' => 'Badan Hukum/Lembaga',
                'nama_lengkap' => 'LSM Peduli Konawe',
                'nik_no_identitas' => '1234567890123456', 
                'email' => 'contact@lsmpedulikonawe.org',
                'no_telp' => '085200001111',
                'alamat' => 'Jl. Abunawas No. 10, Unaaha',
                'pekerjaan' => 'Lembaga Swadaya Masyarakat',
                'rincian_informasi' => 'Laporan Hasil Penilaian (LHP) Inspektorat terkait dana desa Konawe tahun 2025.',
                'tujuan_penggunaan' => 'Pengawasan Publik',
                'cara_memperoleh' => 'Mendapatkan Salinan Hardcopy',
                'cara_mendapatkan' => 'Mengambil Langsung',
                'status' => 'diproses',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
            ],
            [
                'kategori_pemohon' => 'Perorangan',
                'nama_lengkap' => 'Siti Aminah',
                'nik_no_identitas' => '7402020202800002',
                'email' => 'siti.am@ymail.com',
                'no_telp' => '085311223344',
                'alamat' => 'Desa Lalonggowuna, Kecamatan Tongauna',
                'pekerjaan' => 'Mahasiswa',
                'rincian_informasi' => 'Data statistik tenaga kerja dan pengangguran di Kabupaten Konawe periode 2021-2025.',
                'tujuan_penggunaan' => 'Penyusunan Skripsi',
                'cara_memperoleh' => 'Mendapatkan Salinan Softcopy',
                'cara_mendapatkan' => 'Email',
                'status' => 'approved',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(1),
            ]
        ]);

    }

    // untuk memanggil 1 seeder saja, gunakan command berikut di terminal:
    // php artisan db:seed --class=MenuSeeder
}
