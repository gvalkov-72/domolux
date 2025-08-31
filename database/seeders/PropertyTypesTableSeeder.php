<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['bg' => 'Апартамент', 'en' => 'Apartment'],
            ['bg' => 'Къща', 'en' => 'House'],
        ];

        foreach ($types as $type) {
            $model = PropertyType::create(['is_active' => true]);

            foreach ($type as $locale => $name) {
                $model->translations()->create([
                    'locale' => $locale,
                    'key' => 'name',
                    'value' => $name,
                ]);
            }
        }
    }
}
