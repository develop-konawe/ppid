<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KlaMenuSeeder extends Seeder
{
    /**
     * Menambahkan menu KLA di antara REGULASI dan GALERI pada navbar.
     * Menu dibaca dari tabel `menus` oleh header.blade.php.
     */
    public function run(): void
    {
        // Cek apakah menu KLA sudah ada (hindari duplikasi)
        $exists = DB::table('menus')->where('name', 'KLA')->exists();

        if ($exists) {
            $this->command->info('Menu KLA sudah ada, dilewati.');
            return;
        }

        // Geser order menu setelah REGULASI agar memberi ruang untuk KLA
        // Ambil order menu REGULASI terlebih dahulu
        $regulasiMenu = DB::table('menus')
            ->where(function ($q) {
                $q->where('name', 'like', '%Regulasi%')
                  ->orWhere('name', 'like', '%REGULASI%');
            })
            ->whereNull('parent_id')
            ->first();

        if ($regulasiMenu) {
            $klaOrder = $regulasiMenu->order + 1;

            // Geser semua menu yang order-nya >= klaOrder ke atas sebesar 1
            DB::table('menus')
                ->whereNull('parent_id')
                ->where('order', '>=', $klaOrder)
                ->increment('order');

            // Masukkan menu KLA
            $parentId = DB::table('menus')->insertGetId([
                'name'       => 'KLA',
                'url'        => '/kla',
                'type'       => 'custom',
                'parent_id'  => null,
                'order'      => $klaOrder,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info("Menu KLA berhasil ditambahkan pada urutan {$klaOrder} (setelah REGULASI).");
        } else {
            // Jika menu REGULASI tidak ditemukan, cukup tambahkan di akhir
            $maxOrder = DB::table('menus')->whereNull('parent_id')->max('order') ?? 0;
            $parentId = DB::table('menus')->insertGetId([
                'name'       => 'KLA',
                'url'        => '/kla',
                'type'       => 'custom',
                'parent_id'  => null,
                'order'      => $maxOrder + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info("Menu KLA berhasil ditambahkan di urutan {$maxOrder} + 1 (akhir daftar).");
        }
    }
}
