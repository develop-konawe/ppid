<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['name' => 'email', 'key' => 'email', 'value' => '', 'type' => 'string', 'group' => 'general'],
            ['name' => 'Kontak', 'key' => 'contact', 'value' => '', 'type' => 'string', 'group' => 'general'],
            ['name' => 'Gambar Kontak', 'key' => 'contac_image', 'value' => null, 'type' => 'image', 'group' => 'general'],

        ];

        foreach ($settings as $setting) {
            Pengaturan::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
