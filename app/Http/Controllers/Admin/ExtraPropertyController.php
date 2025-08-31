<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use App\Models\ExtraProperty;
use App\Models\Property;
use Illuminate\Http\Request;

class ExtraPropertyController extends Controller
{
    public function store(Request $request)
    {
        $propertyId = $request->input('property_id');
        $extraIds = $request->input('extra_ids', []);

        ExtraProperty::where('property_id', $propertyId)->delete();

        foreach ($extraIds as $extraId) {
            ExtraProperty::create([
                'property_id' => $propertyId,
                'extra_id' => $extraId,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
