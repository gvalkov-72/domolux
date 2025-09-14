<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Създаваме нужните permissions
        $permissions = [
            'view-users',
            'view-roles',
            'view-permissions',
            'view-languages',
            'view-countries',
            'view-cities',
            'view-property_types',
            'view-extras',
            'view-properties',
            'view-districts',
            'view-locations',
            'view-property_images',
            'view-pages',
            'view-sections',
            'view-section-items',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Намираме админ ролята
        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole) {
            // Взимаме всички permissions и ги прикрепяме към admin
            $adminRole->permissions()->sync(Permission::pluck('id')->toArray());
        }
    }
}
