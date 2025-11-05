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
            'id' => 8,
            'name' => 'Profil Singkat PPID',
            'type' => 'custom',
            'url' => '#',
            'order' => 1,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 9,
            'name' => 'Visi dan Misi PPID',
            'type' => 'custom',
            'url' => '#',
            'order' => 2,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 10,
            'name' => 'Struktur PPID',
            'type' => 'custom',
            'url' => '#',
            'order' => 3,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 11,
            'name' => 'Maklumat PPID',
            'type' => 'custom',
            'url' => '#',
            'order' => 4,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 12,
            'name' => 'SOP',
            'type' => 'custom',
            'url' => '#',
            'order' => 5,
        ]);

        Menu::create([
            'id' => 13,
            'name' => 'Standar Pelayanan',
            'type' => 'custom',
            'url' => '#',
            'order' => 6,
            'parent_id' => 1,
        ]);
        // Syarat Permohonan
        // Moto Pelayanan

        Menu::create([
            'id' => 14,
            'name' => 'Sarpras PPID',
            'type' => 'custom',
            'url' => '#',
            'order' => 7,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 15,
            'name' => 'Anggaran PPID',
            'type' => 'custom',
            'url' => '#',
            'order' => 8,
        ]);

        Menu::create([
            'id' => 16,
            'name' => 'Dokumen PPID',
            'type' => 'custom',
            'url' => '#',
            'order' => 9,
            'parent_id' => 1,
        ]);


        // INFORMASI PPID
        Menu::create([
            'id' => 2,
            'name' => 'Informasi Publik',
            'type' => 'custom',
            'url' => '#',
            'order' => 2,
        ]);

        Menu::create([
            'id' => 17,
            'name' => 'Informasi Berkala',
            'type' => 'custom',
            'url' => '#',
            'order' => 1,
            'parent_id' => 2,
        ]);

        Menu::create([
            'id' => 18,
            'name' => 'Informasi Setiap Saat',
            'type' => 'custom',
            'url' => '#',
            'order' => 2,
            'parent_id' => 2,
        ]);

        Menu::create([
            'id' => 19,
            'name' => 'Informasi Serta Merta',
            'type' => 'custom',
            'url' => '#',
            'order' => 3,
            'parent_id' => 2,
        ]);

        Menu::create([
            'id' => 20,
            'name' => 'Informasi Dikecualikan',
            'type' => 'custom',
            'url' => '#',
            'order' => 4,
            'parent_id' => 2,
        ]);

        Menu::create([
            'id' => 21,
            'name' => 'Daftar Informasi Publik',
            'type' => 'custom',
            'url' => '#',
            'order' => 5,
            'parent_id' => 2,
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
