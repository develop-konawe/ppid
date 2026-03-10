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
            [
                'nama_opd' => 'Dinas Komunikasi dan Informatika',
                'singkatan' => 'DISKOMINFO',
                'website' => 'https://diskominfo.contoh.go.id',
                'email' => 'diskominfo@contoh.go.id',
                'telepon' => '021-123456',
                'alamat' => 'Jl. Merdeka No. 1',
                'kepala_opd' => 'Budi Santoso, S.Kom',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_opd' => 'Dinas Kesehatan',
                'singkatan' => 'DINKES',
                'website' => 'https://dinkes.contoh.go.id',
                'email' => 'dinkes@contoh.go.id',
                'telepon' => '021-987654',
                'alamat' => 'Jl. Sehat No. 5',
                'kepala_opd' => 'Dr. Ani Wijaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_opd' => 'Dinas Pendidikan',
                'singkatan' => 'DISDIK',
                'website' => 'https://disdik.contoh.go.id',
                'telepon' => '021-555555',
                'alamat' => 'Jl. Pendidikan No. 3',
                'kepala_opd' => 'Dr. Rina Sari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_opd' => 'BPKAD',
                'singkatan' => 'BPKAD',
                'website' => 'https://bpkad.contoh.go.id',
                'telepon' => '021-222222',
                'alamat' => 'Jl. Keuangan No. 2',
                'kepala_opd' => 'Ir. Agus Pratama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_opd' => 'Sekretariat Daerah',
                'singkatan' => 'SETDA',
                'website' => 'https://setda.contoh.go.id',
                'telepon' => '021-333333',
                'alamat' => 'Jl. Setda No. 4',
                'kepala_opd' => 'Dr. Sari Dewi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_opd' => 'Badan Perencanaan Pembangunan Daerah',
                'singkatan' => 'BAPPEDA',
                'website' => 'https://bappeda.contoh.go.id',
                'email' => 'bappeda@contoh.go.id',
                'telepon' => '021-654321',
                'alamat' => 'Jl. Pemuda No. 10',
                'kepala_opd' => 'Dr. Siti Aminah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($opds as $row) {
            DB::table('opds')->updateOrInsert(
                ['singkatan' => $row['singkatan']],
                [
                    'nama_opd' => $row['nama_opd'],
                    'singkatan' => $row['singkatan'],
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
