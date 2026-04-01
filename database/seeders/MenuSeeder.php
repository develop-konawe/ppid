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
        // PROFIL PPID - Menu Utama

        Menu::create([
            'id' => 1,
            'name' => 'Profil',
            'type' => 'custom',
            'url' => '#',
            'order' => 1,
        ]);

        // Membuat data dummy Halaman Statis untuk Profil
        $pageProfilSingkat = \App\Models\Page::create([
            'title' => 'Profil Singkat PPID',
            'slug' => 'profil-singkat-ppid',
            'content' => '<h3>Profil Singkat PPID Kabupaten Konawe</h3><p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) Kabupaten Konawe dibentuk berdasarkan amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik...</p>',
            'is_active' => true,
        ]);
        $pageVisiMisi = \App\Models\Page::create([
            'title' => 'Visi dan Misi PPID',
            'slug' => 'visi-dan-misi-ppid',
            'content' => '<h3>Visi</h3><p>Terwujudnya pelayanan informasi publik yang transparan, akuntabel, dan responsif.</p><h3>Misi</h3><ul><li>Meningkatkan kualitas pelayanan informasi</li><li>Membangun partisipasi masyarakat</li></ul>',
            'is_active' => true,
        ]);
        $pageStruktur = \App\Models\Page::create([
            'title' => 'Struktur PPID',
            'slug' => 'struktur-ppid',
            'content' => '<h3>Struktur Organisasi PPID</h3><p>Bagan struktur organisasi PPID Pemda Konawe terdiri dari Atasan PPID, PPID Utama, dan PPID Pelaksana pada tingkat OPD.</p>',
            'is_active' => true,
        ]);
        $pageMaklumat = \App\Models\Page::create([
            'title' => 'Maklumat Pelayanan PPID',
            'slug' => 'maklumat-ppid',
            'content' => '<h3>Maklumat Pelayanan</h3><p>Kami berjanji dan sanggup menyelenggarakan pelayanan informasi publik sesuai dengan standar pelayanan yang telah ditetapkan.</p>',
            'is_active' => true,
        ]);
        $pageSop = \App\Models\Page::create([
            'title' => 'SOP PPID',
            'slug' => 'sop-ppid',
            'content' => '<h3>Standar Operasional Prosedur</h3><p>Berikut adalah SOP pengelolaan informasi, SOP penanganan permohonan informasi, dan SOP penyelesaian sengketa informasi.</p>',
            'is_active' => true,
        ]);
        $pageStandarPelayanan = \App\Models\Page::create([
            'title' => 'Standar Pelayanan PPID',
            'slug' => 'standar-pelayanan-ppid',
            'content' => '<h3>Standar Biaya & Waktu</h3><p>Pelayanan informasi publik di PPID Kabupaten Konawe tidak dipungut biaya (Gratis). Waktu penyelesaian maksimal 10 hari kerja.</p>',
            'is_active' => true,
        ]);
        $pageSarpras = \App\Models\Page::create([
            'title' => 'Sarana & Prasarana PPID',
            'slug' => 'sarpras-ppid',
            'content' => '<h3>Sarana dan Prasarana</h3><p>Kami dilengkapi dengan ruang layanan informasi, meja konsultasi, komputer pemohon, dan akses internet gratis.</p>',
            'is_active' => true,
        ]);
        $pageAnggaran = \App\Models\Page::create([
            'title' => 'Anggaran PPID',
            'slug' => 'anggaran-ppid',
            'content' => '<h3>Informasi Anggaran</h3><p>Pelaksanaan operasional PPID dibebankan kepada DPA Dinas Kominfo tahun berjalan.</p>',
            'is_active' => true,
        ]);
        $pageDokumen = \App\Models\Page::create([
            'title' => 'Dokumen Laporan PPID',
            'slug' => 'dokumen-ppid',
            'content' => '<h3>Laporan Tahunan Layanan Informasi</h3><p>Ringkasan laporan tahunan tentang pelayanan informasi publik PPID dapat diunduh di halaman ini.</p>',
            'is_active' => true,
        ]);

        // Sub Menu Profil
        Menu::create([
            'id' => 8,
            'name' => 'Profil Singkat PPID',
            'type' => 'page',
            'page_id' => $pageProfilSingkat->id,
            'url' => null,
            'order' => 1,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 9,
            'name' => 'Visi dan Misi PPID',
            'type' => 'page',
            'page_id' => $pageVisiMisi->id,
            'url' => null,
            'order' => 2,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 10,
            'name' => 'Struktur PPID',
            'type' => 'page',
            'page_id' => $pageStruktur->id,
            'url' => null,
            'order' => 3,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 11,
            'name' => 'Maklumat PPID',
            'type' => 'page',
            'page_id' => $pageMaklumat->id,
            'url' => null,
            'order' => 4,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 12,
            'name' => 'SOP',
            'type' => 'page',
            'page_id' => $pageSop->id,
            'url' => null,
            'order' => 5,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 13,
            'name' => 'Standar Pelayanan',
            'type' => 'page',
            'page_id' => $pageStandarPelayanan->id,
            'url' => null,
            'order' => 6,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 14,
            'name' => 'Sarpras PPID',
            'type' => 'page',
            'page_id' => $pageSarpras->id,
            'url' => null,
            'order' => 7,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 15,
            'name' => 'Anggaran PPID',
            'type' => 'page',
            'page_id' => $pageAnggaran->id,
            'url' => null,
            'order' => 8,
            'parent_id' => 1,
        ]);

        Menu::create([
            'id' => 16,
            'name' => 'Dokumen PPID',
            'type' => 'page',
            'page_id' => $pageDokumen->id,
            'url' => null,
            'order' => 9,
            'parent_id' => 1,
        ]);


        // INFORMASI PPID - Menu Utama
        Menu::create([
            'id' => 2,
            'name' => 'Informasi Publik',
            'type' => 'custom',
            'url' => '#',
            'order' => 2,
        ]);

        // Sub Menu Informasi Publik
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

        // Menu Utama Lainnya
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
