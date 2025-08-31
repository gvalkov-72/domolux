<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\City;
use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    public function run(): void
    {
        $city = City::first();

        $districts = [
            ['bg' => 'Лозенец', 'en' => 'Lozenets'],
            ['bg' => 'Младост', 'en' => 'Mladost'],
        ];

        foreach ($districts as $district) {
            $model = District::create([
                'city_id' => $city->id,
                'is_active' => true,
            ]);

            foreach ($district as $locale => $name) {
                $model->translations()->create([
                    'locale' => $locale,
                    'key' => 'name',
                    'value' => $name,
                ]);
            }
        }
    }
}
