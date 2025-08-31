<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['code' => 'BG', 'bg' => 'България', 'en' => 'Bulgaria'],
            ['code' => 'DE', 'bg' => 'Германия', 'en' => 'Germany'],
        ];

        foreach ($countries as $country) {
            // Създаваме страната с code и is_active
            $model = Country::create([
                'code' => $country['code'],
                'is_active' => true,
            ]);

            // Добавяме преводите за името
            foreach ($country as $locale => $name) {
                if ($locale === 'code') {
                    continue; // пропускаме кода
                }

                $model->translations()->create([
                    'locale' => $locale,
                    'key' => 'name',
                    'value' => $name,
                ]);
            }
        }
    }
}
