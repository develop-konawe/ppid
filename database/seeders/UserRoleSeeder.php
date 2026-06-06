<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ===============================
        // Daftar Permission CMS PPID
        // ===============================

        $permissions = [
            // Informasi Publik
            'info.create',
            'info.edit',
            'info.delete',
            'info.publish',
            'info.verify',

            // Permohonan Informasi
            'permohonan.view',
            'permohonan.verify',
            'permohonan.respond',
            'permohonan.delete',

            // OPD / Dinas
            'opd.create',
            'opd.edit',
            'opd.delete',
            'opd.manage_user',

            // User Management
            'user.create',
            'user.edit',
            'user.delete',
            'user.assign_role',
            'user.reset_password',

            // Laporan
            'report.view',
            'report.export',
        ];

        // ===============================
        // Insert Permission
        // ===============================

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // ===============================
        // Create Roles
        // ===============================

        $operatorPpid = Role::firstOrCreate([
            'name' => 'operator_ppid',
            'guard_name' => 'web'
        ]);

        $ppidPelaksana = Role::firstOrCreate([
            'name' => 'ppid_pelaksana',
            'guard_name' => 'web'
        ]);

        // ===============================
        // Assign Permission ke Role
        // ===============================

        // Operator PPID → Semua permission
        $operatorPpid->syncPermissions(Permission::all());

        // PPID Pelaksana → Permission terbatas
        $ppidPelaksana->syncPermissions([
            'info.create',
            'info.edit',
            'info.publish',
            'permohonan.view',
            'permohonan.respond',
            'report.view',
        ]);

        // ===============================
        // Contoh Assign Role ke User
        // ===============================
        // (Optional — bisa dihapus kalau tidak perlu)

        $admin = User::where('email', 'ppid_admin@gmail.com')->first();
        if ($admin) {
            $admin->syncRoles(['operator_ppid']);
        }

        $ppid = User::where('email', 'rsud_admin@gmail.com')->first();
        if ($ppid) {
            $ppid->syncRoles(['ppid_pelaksana']);
        }
    }
}
