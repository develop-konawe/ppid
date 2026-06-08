<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpdSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $opdData = [
            ['Dinas Komunikasi dan Informatika', 'DISKOMINFO'],
            ['Dinas Peternakan dan Kesehatan Hewan', 'DISNAKESWAN'],
            ['Badan Pendapatan Daerah', 'BAPENDA'],
            ['Dinas Tanaman Pangan, Hortikultura dan Perkebunan', 'DISTANHORBUN'],
            ['Dinas Perhubungan', 'DISHUB'],
            ['Dinas Kesehatan', 'DINKES'],
            ['Badan Perencanaan Pembangunan Daerah', 'BAPPEDA'],
            ['Satuan Polisi Pamong Praja', 'SATPOLPP'],
            ['Dinas Lingkungan Hidup', 'DLH'],
            ['Sekretariat Daerah', 'SETDA'],
            ['Dinas Pendidikan dan Kebudayaan', 'DIKBUD'],
            ['Dinas Pekerjaan Umum dan Penataan Ruang', 'PUPR'],
            ['Dinas Perumahan dan Kawasan Permukiman', 'DISPERKIM'],
            ['Dinas Pemadam Kebakaran dan Penyelamatan', 'DAMKAR'],
            ['Dinas Sosial', 'DINSOS'],
            ['Dinas Transmigrasi dan Tenaga Kerja', 'DISTRANSNAKER'],
            ['Dinas Pemberdayaan Perempuan dan Perlindungan Anak', 'DP3A'],
            ['Dinas Ketahanan Pangan', 'DISKETAPANG'],
            ['Dinas Administrasi Kependudukan dan Pencatatan Sipil', 'DISDUKCAPIL'],
            ['Dinas Pemberdayaan Masyarakat dan Desa', 'DPMD'],
            ['Dinas Pengendalian Penduduk dan Keluarga Berencana', 'DPPKB'],
            ['Dinas Perdagangan dan Perindustrian', 'DISPERINDAG'],
            ['Dinas Koperasi dan UKM', 'DISKOPUKM'],
            ['Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 'DPMPTSP'],
            ['Dinas Kepemudaan dan Olahraga', 'DISPORA'],
            ['Dinas Perpustakaan dan Kearsipan', 'DISPUSIP'],
            ['Dinas Perikanan', 'DISKAN'],
            ['Dinas Pariwisata dan Ekonomi Kreatif', 'DISPAREKRAF'],
            ['Sekretariat DPRD', 'SETDPRD'],
            ['Inspektorat', 'INSPEKTORAT'],
            ['Badan Pengelola Keuangan dan Aset Daerah', 'BPKAD'],
            ['Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 'BKPSDM'],
            ['Badan Riset dan Inovasi Daerah', 'BRIDA'],
            ['Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat', 'KESBANGPOL'],
            ['Badan Penanggulangan Bencana Daerah', 'BPBD'],
        ];

        foreach ($opdData as $row) {
            DB::table('opds')->updateOrInsert(
                ['nama_opd' => $row[0]],
                [
                    'singkatan' => $row[1],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ OPD seeded successfully.');
    }
}
