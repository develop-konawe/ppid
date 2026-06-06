<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class KlaRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define KLA Permissions
        $permissions = [
            'kla.view',
            'kla.create',
            'kla.update',
            'kla.delete',
            'kla.publish',
            'kla.monitoring.manage',
            'kla.complaint.manage',
            'kla.statistics.manage',
            'kla.regulation.manage',
            'kla.gallery.manage',
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Roles and assign permissions
        
        // 1. admin_kla (Full access to KLA)
        $adminKla = Role::firstOrCreate(['name' => 'admin_kla', 'guard_name' => 'web']);
        $adminKla->syncPermissions($permissions);

        // 2. operator_kla (Manage content, but limited admin powers)
        $operatorKla = Role::firstOrCreate(['name' => 'operator_kla', 'guard_name' => 'web']);
        $operatorKla->syncPermissions([
            'kla.view',
            'kla.create',
            'kla.update',
            'kla.publish',
            'kla.statistics.manage',
            'kla.regulation.manage',
            'kla.gallery.manage',
        ]);

        // 3. verifikator_kla (Verify indicators and complaints)
        $verifikatorKla = Role::firstOrCreate(['name' => 'verifikator_kla', 'guard_name' => 'web']);
        $verifikatorKla->syncPermissions([
            'kla.view',
            'kla.monitoring.manage',
            'kla.complaint.manage',
        ]);

        // If admin_utama exists, assign all KLA permissions to it as well
        $adminUtama = Role::where('name', 'admin_utama')->where('guard_name', 'web')->first();
        if ($adminUtama) {
            $adminUtama->givePermissionTo($permissions);
        }
    }
}
