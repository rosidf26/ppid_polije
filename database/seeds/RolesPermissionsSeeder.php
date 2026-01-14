<?php

use Illuminate\Database\Seeder;
use Backpack\PermissionManager\app\Models\Role;
use Backpack\PermissionManager\app\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ===== ROLES =====
        $roles = [
            'Operator',
            'Atasan PPID',
            'Admin',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role],
                ['guard_name' => 'backpack']
            );
        }

        // ===== PERMISSIONS =====
        $permissions = Permission::pluck('name')->toArray();

        // Admin gets ALL permissions
        Role::where('name', 'Admin')->first()->syncPermissions($permissions);

        // Operator Permissions
        Role::where('name', 'Operator')->first()->syncPermissions([
            'kelola pengguna',
            'kelola konten',
            'ubah halaman',
            'lihat dashboard',
            'lihat permohonan',
            'respon permohonan',
            'lihat keberatan',
            'export permohonan',
            'export keberatan',
        ]);

        // Atasan PPID Permissions
        Role::where('name', 'Atasan PPID')->first()->syncPermissions([
            'lihat dashboard',
            'lihat permohonan',
            'lihat keberatan',
            'respon keberatan',
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
