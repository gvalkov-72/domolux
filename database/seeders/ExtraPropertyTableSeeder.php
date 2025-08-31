<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Extra;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ExtraPropertyTableSeeder extends Seeder
{
    public function run(): void
    {
        $extras = Extra::all();

        // ✅ User (администратор)
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        // ✅ Country
        $countryId = DB::table('countries')->value('id') ?? DB::table('countries')->insertGetId([
            'is_active' => true,
            'code' => 'BG',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ✅ City
        $cityId = DB::table('cities')->value('id') ?? DB::table('cities')->insertGetId([
            'country_id' => $countryId,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ✅ District
        $districtId = DB::table('districts')->value('id') ?? DB::table('districts')->insertGetId([
            'city_id' => $cityId,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ✅ Location
        $locationId = DB::table('locations')->value('id') ?? DB::table('locations')->insertGetId([
            'district_id' => $districtId,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ✅ PropertyType
        $propertyTypeId = DB::table('property_types')->value('id') ?? DB::table('property_types')->insertGetId([
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ✅ Property (с всички задължителни полета)
        $property = Property::first();
        if (!$property) {
            $property = Property::create([
                'user_id' => $user->id,
                'is_active' => true,
                'property_type_id' => $propertyTypeId,
                'country_id' => $countryId,
                'city_id' => $cityId,
                'district_id' => $districtId,
                'location_id' => $locationId,
                'price' => 100000,
                'offer_type' => 'sale', // или 'rent'
                'code' => 'PROP-001',
            ]);
        }

        // ✅ Свързваме Extras с Property
        foreach ($extras as $extra) {
            DB::table('extra_property')->insert([
                'property_id' => $property->id,
                'extra_id' => $extra->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
