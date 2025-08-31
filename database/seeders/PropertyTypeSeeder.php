<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Апартамент', 'Къща', 'Офис', 'Магазин', 'Парцел', 'Склад'];

        foreach ($types as $type) {
            PropertyType::create(['name' => $type]);
        }
    }
}
