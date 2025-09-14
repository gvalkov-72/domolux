<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Създаване на администратора
        $admin = 

        // Вземаме или създаваме ролята "admin"
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // ✅ Присвояваме ролята на потребителя
        $admin->assignRole($adminRole);
    }
}
