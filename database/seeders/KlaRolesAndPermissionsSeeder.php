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
        
        // 1. operator_kla (Manage content, but limited admin powers)
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

        // If operator_ppid exists, assign all KLA permissions to it as well
        $operatorPpid = Role::where('name', 'operator_ppid')->where('guard_name', 'web')->first();
        if ($operatorPpid) {
            $operatorPpid->givePermissionTo($permissions);
        }
    }
}
