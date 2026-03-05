<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpdSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $opds = [
            ['nama_opd' => 'Dinas Komunikasi dan Informatika', 'singkatan' => 'DISKOMINFO'],
            ['nama_opd' => 'Dinas Kesehatan', 'singkatan' => 'DINKES'],
            ['nama_opd' => 'Dinas Pendidikan', 'singkatan' => 'DISDIK'],
            ['nama_opd' => 'BPKAD', 'singkatan' => 'BPKAD'],
            ['nama_opd' => 'Sekretariat Daerah', 'singkatan' => 'SETDA'],
        ];

        foreach ($opds as $row) {
            DB::table('opds')->updateOrInsert(
                ['singkatan' => $row['singkatan']],
                [
                    'nama_opd' => $row['nama_opd'],
                    'website' => null,
                    'email' => null,
                    'telepon' => null,
                    'alamat' => null,
                    'logo' => null,
                    'kepala_opd' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ OPD seeded successfully.');
    }
}
