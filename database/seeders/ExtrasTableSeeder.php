<?php

namespace Database\Seeders;

use App\Models\Extra;
use Illuminate\Database\Seeder;

class ExtrasTableSeeder extends Seeder
{
    public function run(): void
    {
        $extras = [
            ['bg' => 'Климатик', 'en' => 'Air Conditioning'],
            ['bg' => 'Паркинг', 'en' => 'Parking'],
        ];

        foreach ($extras as $extra) {
            $model = Extra::create(['is_active' => true]);

            foreach ($extra as $locale => $name) {
                $model->translations()->create([
                    'locale' => $locale,
                    'key' => 'name',
                    'value' => $name,
                ]);
            }
        }
    }
}
