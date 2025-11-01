<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'id' => 1,
            'name' => 'Profil',
            'type' => 'custom',
            'url' => '#',
            'order' => 1,
        ]);

        Menu::create([
            'id' => 2,
            'name' => 'Informasi Publik',
            'type' => 'custom',
            'url' => '#',
            'order' => 2,
        ]);

        Menu::create([
            'id' => 3,
            'name' => 'Berita',
            'type' => 'news',
            'order' => 3,
        ]);

        Menu::create([
            'id' => 4,
            'name' => 'Pengumuman',
            'type' => 'announcement',
            'order' => 4,
        ]);

        Menu::create([
            'id' => 5,
            'name' => 'Regulasi',
            'type' => 'custom',
            'url' => route('regulation'),
            'order' => 5,
        ]);

        Menu::create([
            'id' => 6,
            'name' => 'Galeri',
            'type' => 'custom',
            'url' => route('gallery'),
            'order' => 6,
        ]);

        Menu::create([
            'id' => 7,
            'name' => 'Kontak',
            'type' => 'custom',
            'url' => route('contact'),
            'order' => 7,
        ]);
    }
}
