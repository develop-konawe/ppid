<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regulations')->insert([
            [
                'title' => 'UU No. 14 Tahun 2008',
                'summary' => 'Undang-Undang tentang Keterbukaan Informasi Publik.',
                'doc_url' => 'https://example.com/uu-14-2008.pdf',
                'issue_date' => '2008-04-30',
                'source_type' => 'ppid_utama',
                'opd_id' => null,
                'created_by' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
