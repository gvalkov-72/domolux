<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\District;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $district = District::first();

        $locations = [
            ['bg' => 'Южен парк', 'en' => 'South Park'],
            ['bg' => 'Бизнес парк София', 'en' => 'Business Park Sofia'],
        ];

        foreach ($locations as $location) {
            $model = Location::create([
                'district_id' => $district->id,
                'is_active' => true,
            ]);

            foreach ($location as $locale => $name) {
                $model->translations()->create([
                    'locale' => $locale,
                    'key' => 'name',
                    'value' => $name,
                ]);
            }
        }
    }
}
