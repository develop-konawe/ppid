<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'ppid_admin@gmail.com',
            'password' => '12345678',
            'is_super_admin' => true,
            'opd_id' => null, // Super admin tidak terkait dengan OPD tertentu
            'created_at' => now(),
        ]);

        User::create([
            'name' => 'RSUD Konawe',
            'email' => 'rsud_admin@gmail.com',
            'password' => '12345678',
            'is_super_admin' => false,
            'opd_id' => 2, // Merujuk ke RSUD Konawe
            'created_at' => now(),
        ]);

        User::create([
                'name' => 'Admin Diskominfo',
                'email' => 'diskominfo@mail.com',
                'password' => '12345678',
                'is_super_admin' => false,
                'opd_id' => 1, // Merujuk ke Diskominfo
                'created_at' => now(),
        ]);
    }
}
