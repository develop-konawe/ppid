<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migration di nonaktifkan agar tidak mengganggu logic role yang sudah diterapkan di form resource
        // dan seeder (KlaRolesAndPermissionsSeeder & UserRoleSeeder).
        
        // $adminUtama = Role::where('name', 'admin_utama')->first();
        // if ($adminUtama) {
        //     $adminUtama->name = 'operator_ppid';
        //     $adminUtama->save();
        // }

        // Role::whereIn('name', ['admin_kla', 'verifikator_kla'])->delete();
        
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // $operatorPpid = Role::where('name', 'operator_ppid')->first();
        // if ($operatorPpid) {
        //     $operatorPpid->name = 'admin_utama';
        //     $operatorPpid->save();
        // }

        // Role::firstOrCreate(['name' => 'admin_kla', 'guard_name' => 'web']);
        // Role::firstOrCreate(['name' => 'verifikator_kla', 'guard_name' => 'web']);
        
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
};
