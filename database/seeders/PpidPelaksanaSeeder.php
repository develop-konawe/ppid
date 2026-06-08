<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Opd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PpidPelaksanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Memastikan role ppid_pelaksana ada
        $role = Role::firstOrCreate(['name' => 'ppid_pelaksana', 'guard_name' => 'web']);

        // Mengambil semua data OPD
        $opds = Opd::all();

        foreach ($opds as $opd) {
            // Membuat format email yang unik berdasarkan singkatan atau nama OPD
            $emailPrefix = strtolower(str_replace(' ', '', $opd->singkatan ?? $opd->nama_opd));
            $email = 'ppid.' . $emailPrefix . '@example.com';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => 'PPID ' . ($opd->singkatan ?? $opd->nama_opd),
                    'password' => Hash::make('password'),
                    'is_super_admin' => false,
                    'opd_id' => $opd->id,
                ]
            );

            // Assign role ppid_pelaksana ke user
            if (!$user->hasRole('ppid_pelaksana')) {
                $user->assignRole($role);
            }
        }
        
        $this->command->info('✅ Users dengan role ppid_pelaksana untuk setiap OPD berhasil di-generate.');
    }
}
