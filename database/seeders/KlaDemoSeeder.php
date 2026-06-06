<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\KlaCluster;
use App\Models\KlaProgram;
use App\Models\KlaRegulation;
use App\Models\KlaPartner;
use App\Models\KlaService;
use App\Models\KlaFaq;
use App\Models\KlaIndicator;
use App\Models\KlaPartnerCategory;
use App\Models\KlaStatistic;

class KlaDemoSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::first();
        if ($adminUser) {
            Auth::login($adminUser);
        }
        $adminId = $adminUser ? $adminUser->id : 1;

        // Statistik KLA (ditampilkan di halaman KLA publik)
        $defaultMetrics = [
            ['label' => 'Klaster KLA',       'value' => '5',    'icon' => 'fa-solid fa-layer-group',       'color' => '#3b82f6'],
            ['label' => 'Indikator Utama',    'value' => '24',   'icon' => 'fa-solid fa-chart-pie',         'color' => '#10b981'],
            ['label' => 'Evaluasi Nasional',  'value' => '2024', 'icon' => 'fa-solid fa-calendar-check',   'color' => '#f59e0b'],
            ['label' => 'Komitmen OPD',       'value' => '100%', 'icon' => 'fa-solid fa-handshake-angle',  'color' => '#8b5cf6'],
        ];

        foreach ($defaultMetrics as $i => $stat) {
            KlaStatistic::updateOrCreate(['label' => $stat['label']], [
                'value'      => $stat['value'],
                'icon'       => $stat['icon'],
                'color'      => $stat['color'],
                'order'      => $i + 1,
                'is_active'  => true,
                'created_by' => $adminId,
            ]);
        }

        // Klaster KLA
        $defaultClusters = [
            ['name' => 'Hak Sipil & Kebebasan',              'description' => 'Jaminan hak identitas, kebebasan berpikir, beragama, dan akses informasi layak bagi anak.',             'icon' => 'fa-solid fa-id-card',         'color' => '#1F3A8A', 'order' => 1],
            ['name' => 'Lingkungan Keluarga & Pengasuhan',   'description' => 'Dukungan hak anak tumbuh dalam keluarga harmonis dan pengasuhan yang layak.',                           'icon' => 'fa-solid fa-house-heart',     'color' => '#059669', 'order' => 2],
            ['name' => 'Kesehatan Dasar & Kesejahteraan',    'description' => 'Pemenuhan hak anak atas kesehatan, gizi, sanitasi, dan lingkungan hidup sehat.',                        'icon' => 'fa-solid fa-heart-pulse',     'color' => '#dc2626', 'order' => 3],
            ['name' => 'Pendidikan, Waktu Luang & Budaya',   'description' => 'Jaminan akses pendidikan berkualitas, waktu bermain, dan pengembangan bakat anak.',                     'icon' => 'fa-solid fa-graduation-cap', 'color' => '#7c3aed', 'order' => 4],
            ['name' => 'Perlindungan Khusus',                'description' => 'Perlindungan dari kekerasan, eksploitasi, diskriminasi, dan situasi darurat.',                          'icon' => 'fa-solid fa-shield-heart',    'color' => '#d97706', 'order' => 5],
        ];

        foreach ($defaultClusters as $cluster) {
            KlaCluster::updateOrCreate(['name' => $cluster['name']], [
                'description' => $cluster['description'],
                'icon'        => $cluster['icon'],
                'color'       => $cluster['color'],
                'order'       => $cluster['order'],
                'is_active'   => true,
                'created_by'  => $adminId,
            ]);
        }

        // Program & Kegiatan KLA
        $defaultPrograms = [
            ['title' => 'Sosialisasi KLA bagi OPD Kabupaten Konawe', 'event_date' => '2025-05-15', 'location' => 'Aula Pemkab Konawe',  'description' => 'Pembekalan teknis kepada seluruh OPD terkait indikator dan capaian program KLA Tahun 2025.'],
            ['title' => 'Forum Anak Tingkat Kabupaten',               'event_date' => '2025-04-22', 'location' => 'Gedung Serbaguna',    'description' => 'Musyawarah forum anak sebagai wadah aspirasi anak Konawe dalam perencanaan pembangunan.'],
            ['title' => 'Pelatihan Sekolah Ramah Anak',               'event_date' => '2025-04-10', 'location' => 'SMPN 1 Unaaha',       'description' => 'Penguatan kapasitas guru dan tenaga kependidikan dalam menciptakan lingkungan sekolah yang ramah anak.'],
        ];

        foreach ($defaultPrograms as $prog) {
            KlaProgram::updateOrCreate(['title' => $prog['title']], [
                'event_date'  => $prog['event_date'],
                'location'    => $prog['location'],
                'description' => $prog['description'],
                'is_active'   => true,
                'created_by'  => $adminId,
            ]);
        }

        // Regulasi KLA
        $defaultRegs = [
            ['title' => 'Perpres No. 25 Tahun 2021 tentang Kebijakan KLA',     'issue_date' => '2021-01-01', 'summary' => 'Landasan hukum nasional program KLA.'],
            ['title' => 'Peraturan Menteri PPPA No. 12 Tahun 2022',             'issue_date' => '2022-01-01', 'summary' => 'Standar Operasional Prosedur KLA bagi pemerintah daerah.'],
            ['title' => 'Peraturan Daerah Kab. Konawe tentang Perlindungan Anak', 'issue_date' => '2023-01-01', 'summary' => 'Regulasi daerah perlindungan dan pemenuhan hak anak di Kabupaten Konawe.'],
        ];

        foreach ($defaultRegs as $reg) {
            KlaRegulation::updateOrCreate(['title' => $reg['title']], [
                'issue_date'  => $reg['issue_date'],
                'summary'     => $reg['summary'],
                'is_active'   => true,
                'created_by'  => $adminId,
            ]);
        }

        // Kategori Mitra & Data Mitra KLA
        $catPartner = KlaPartnerCategory::updateOrCreate(['slug' => 'umum'], [
            'name'      => 'Umum',
            'is_active' => true,
        ]);

        $defaultPartners = [
            ['name' => 'Dinas P3A',       'description' => 'Dinas Pemberdayaan Perempuan & Perlindungan Anak', 'order' => 1],
            ['name' => 'Dinas Pendidikan', 'description' => 'Dinas Pendidikan Kab. Konawe',                    'order' => 2],
            ['name' => 'Dinas Kesehatan',  'description' => 'Dinas Kesehatan Kab. Konawe',                     'order' => 3],
            ['name' => 'Bappeda',          'description' => 'Badan Perencanaan Pembangunan Daerah',             'order' => 4],
            ['name' => 'BPBD',             'description' => 'Badan Penanggulangan Bencana Daerah',              'order' => 5],
        ];

        foreach ($defaultPartners as $part) {
            KlaPartner::updateOrCreate(['name' => $part['name']], [
                'category_id' => $catPartner->id,
                'description' => $part['description'],
                'order'       => $part['order'],
                'is_active'   => true,
                'created_by'  => $adminId,
            ]);
        }

        // Layanan ILA (tabel kla_services tidak memiliki category_id)
        $ilaServices = [
            ['name' => 'Lembaga Layanan Informasi Anak', 'description' => 'Pusat layanan informasi resmi bagi anak, orang tua, dan pemangku kepentingan seputar perlindungan dan pemenuhan hak anak.'],
            ['name' => 'Data Akses Layanan Anak',         'description' => 'Sistem data terpadu yang merekam keterjangkauan dan pemanfaatan layanan anak di seluruh wilayah Kabupaten Konawe.'],
            ['name' => 'Layanan ILA bagi AMPK',           'description' => 'Layanan khusus bagi Anak Memerlukan Perlindungan Khusus (AMPK), termasuk anak difabel, anak terlantar, dan korban kekerasan.'],
            ['name' => 'Pengawasan Konten Anak',          'description' => 'Pemantauan dan pengawasan konten digital yang ramah anak, serta literasi digital untuk keamanan anak di dunia maya.'],
        ];

        foreach ($ilaServices as $svc) {
            KlaService::updateOrCreate(['name' => $svc['name']], [
                'description' => $svc['description'],
                'is_active'   => true,
                'created_by'  => $adminId,
            ]);
        }

        // Tentang KLA
        \App\Models\KlaAbout::updateOrCreate(['title' => 'PPID Kabupaten Konawe'], [
            'description' => '<p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) Kabupaten Konawe berkomitmen penuh dalam mewujudkan Kabupaten Layak Anak melalui penyediaan informasi yang transparan dan ramah anak.</p>',
            'vision'      => '<p>Terwujudnya Kabupaten Konawe yang inklusif, sejahtera, dan memenuhi hak-hak dasar anak secara menyeluruh.</p>',
            'mission'     => '<ul><li>Meningkatkan komitmen pemerintah dan masyarakat.</li><li>Memperkuat kelembagaan KLA.</li></ul>',
            'goals'       => '<p>Memastikan setiap anak di Kabupaten Konawe mendapatkan haknya.</p>',
            'is_active'   => true,
            'created_by'  => $adminId,
        ]);
    }
}
