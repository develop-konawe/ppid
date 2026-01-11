<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::create([
            'type' => 'photo',
            'caption' => 'Foto Kegiatan 1',
            'media_path' => 'gallery/36.jpg',
            'created_by' => 1,
        ]);
        Gallery::create([
            'type' => 'photo',
            'caption' => 'Foto Kegiatan 2',
            'media_path' => 'gallery/37.jpg',
            'created_by' => 1,
        ]);
        Gallery::create([
            'type' => 'photo',
            'caption' => 'Foto Kegiatan 3',
            'media_path' => 'gallery/38.jpg',
            'created_by' => 1,
        ]);
        // buat sampai 41
        Gallery::create([
            'type' => 'photo',
            'caption' => 'Foto Kegiatan 4',
            'media_path' => 'gallery/39.jpg',
            'created_by' => 1,
        ]);
        Gallery::create([
            'type' => 'photo',
            'caption' => 'Foto Kegiatan 5',
            'media_path' => 'gallery/40.jpg',
            'created_by' => 1,
        ]);
        Gallery::create([
            'type' => 'photo',
            'caption' => 'Foto Kegiatan 6',
            'media_path' => 'gallery/41.jpg',
            'created_by' => 1,
        ]);
    }
}
