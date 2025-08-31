<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function cities(Request $request)
    {
        $countryId = $request->get('country_id');
        $cities = City::where('country_id', $countryId)->get()
            ->map(function ($city) {
                return [
                    'id' => $city->id,
                    'name' => $city->translate('bg')->name ?? $city->id,
                ];
            });

        return response()->json($cities);
    }

    public function districts(Request $request)
    {
        $cityId = $request->get('city_id');
        $districts = District::where('city_id', $cityId)->get()
            ->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->translate('bg')->name ?? $d->id,
                ];
            });

        return response()->json($districts);
    }
}
