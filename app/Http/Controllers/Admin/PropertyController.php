<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Country;
use App\Models\City;
use App\Models\District;
use App\Models\Location;
use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with(['propertyTypes', 'countries', 'cities', 'districts', 'locations', 'extras', 'user'])
            ->orderBy('position')
            ->paginate(20);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $propertyTypes = PropertyType::all();
        $countries     = Country::all();
        $cities        = City::all();
        $districts     = District::all();
        $locations     = Location::all();
        $extras        = Extra::all();

        // Създаваме празен Property за формата
        $property = new Property();

        return view('admin.properties.create', compact(
            'property', 'propertyTypes', 'countries', 'cities', 'districts', 'locations', 'extras'
        ));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->only([
                'code', 'position', 'price_bgn', 'price_eur',
                'active_from', 'active_until'
            ]);

            $data['is_active'] = $request->boolean('is_active');
            $data['user_id']   = Auth::id();

            $property = Property::create($data);

            // преводи
            foreach ($request->input('translations', []) as $locale => $fields) {
                foreach ($fields as $field => $value) {
                    $property->setTranslation($field, $locale, $value);
                }
            }
            $property->save();

            // връзки
            $property->propertyTypes()->sync($request->input('property_type_ids', []));
            $property->countries()->sync($request->input('country_ids', []));
            $property->cities()->sync($request->input('city_ids', []));
            $property->districts()->sync($request->input('district_ids', []));
            $property->locations()->sync($request->input('location_ids', []));
            $property->extras()->sync($request->input('extra_ids', []));
        });

        return redirect()->route('admin.properties.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit(Property $property)
    {
        $propertyTypes = PropertyType::all();
        $countries     = Country::all();
        $cities        = City::all();
        $districts     = District::all();
        $locations     = Location::all();
        $extras        = Extra::all();

        $property->load(['propertyTypes', 'countries', 'cities', 'districts', 'locations', 'extras', 'images']);

        return view('admin.properties.edit', compact(
            'property', 'propertyTypes', 'countries', 'cities', 'districts', 'locations', 'extras'
        ));
    }

    public function update(Request $request, Property $property)
    {
        DB::transaction(function () use ($request, $property) {
            $data = $request->only([
                'code', 'position', 'price_bgn', 'price_eur',
                'active_from', 'active_until'
            ]);

            $data['is_active'] = $request->boolean('is_active');

            $property->update($data);

            // преводи
            foreach ($request->input('translations', []) as $locale => $fields) {
                foreach ($fields as $field => $value) {
                    $property->setTranslation($field, $locale, $value);
                }
            }
            $property->save();

            // връзки
            $property->propertyTypes()->sync($request->input('property_type_ids', []));
            $property->countries()->sync($request->input('country_ids', []));
            $property->cities()->sync($request->input('city_ids', []));
            $property->districts()->sync($request->input('district_ids', []));
            $property->locations()->sync($request->input('location_ids', []));
            $property->extras()->sync($request->input('extra_ids', []));
        });

        return redirect()->route('admin.properties.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', __('messages.deleted_successfully'));
    }
}
