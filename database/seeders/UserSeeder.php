<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Създаваме потребителя
        $user = User::create([
            'name' => 'Georgi Valkov',
            'email' => 'gvalkov72@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'), // можеш да смениш с по-сигурна парола
            'remember_token' => Str::random(10),
        ]);

        // Взимаме ролята admin
        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole) {
            // Прикачи ролята на потребителя
            $user->roles()->attach($adminRole->id);
        }
    }
}
