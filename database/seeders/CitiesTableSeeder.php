<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    public function run(): void
    {
        $country = Country::first();

        $cities = [
            ['bg' => 'София', 'en' => 'Sofia'],
            ['bg' => 'Пловдив', 'en' => 'Plovdiv'],
        ];

        foreach ($cities as $city) {
            $model = City::create([
                'country_id' => $country->id,
                'is_active' => true,
            ]);

            foreach ($city as $locale => $name) {
                $model->translations()->create([
                    'locale' => $locale,
                    'key' => 'name',
                    'value' => $name,
                ]);
            }
        }
    }
}
