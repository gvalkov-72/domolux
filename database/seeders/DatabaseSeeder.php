<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Стартираме сеедъра за ролите
        $this->call([
            RoleSeeder::class,
            UserSeeder::class, // <--- новият сеедър за реалния админ
            PermissionSeeder::class,
            LanguageSeeder::class,
            CountriesTableSeeder::class,
            CitiesTableSeeder::class,
            DistrictsTableSeeder::class,
            LocationsTableSeeder::class,
            PropertyTypesTableSeeder::class,
            ExtrasTableSeeder::class,
            PageSeeder::class,
            SectionsSeeder::class,

        ]);


        // Създаваме тестов потребител
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
    }
}
