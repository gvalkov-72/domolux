<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['city' => 'София', 'district' => 'Лозенец'],
            ['city' => 'София', 'district' => 'Младост'],
            ['city' => 'Пловдив', 'district' => 'Център'],
            ['city' => 'Варна', 'district' => 'Чайка'],
            ['city' => 'Бургас', 'district' => 'Лазур'],
        ];

        foreach ($locations as $loc) {
            Location::create($loc);
        }
    }
}
