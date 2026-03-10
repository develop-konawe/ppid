<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carousels')->insert([
            [
                'title' => 'Selamat Datang di PPID',
                'caption' => 'Layanan informasi publik yang transparan dan akuntabel.',
                'image' => 'test.jpg',
                'link_url' => '#',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'title' => 'Hak Anda Untuk Tahu',
                'caption' => 'Gunakan hak informasi Anda untuk Indonesia yang lebih baik.',
                'image' => 'test.jpg',
                'link_url' => '/page/tata-cara-permohonan',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'title' => 'Judul 3',
                'caption' => 'Caption judul 3', // Ubah C menjadi huruf kecil
                'image' => 'test.jpg',
                'link_url' => null,             // Tambahkan key ini
                'sort_order' => 3,
                'is_active' => true,            // Tambahkan key ini
                'created_at' => now(),
            ]
        ]);

    }
}
