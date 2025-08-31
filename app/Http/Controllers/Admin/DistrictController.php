<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\City;
use App\Models\Language;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::with('city')->paginate(15);
        return view('admin.districts.index', compact('districts'));
    }

    public function create()
    {
        $languages = Language::active()->orderBy('position')->get();
        $cities = City::where('is_active', true)->get();
        return view('admin.districts.create', compact('languages', 'cities'));
    }

    public function store(Request $request)
    {
        $district = District::create([
            'city_id' => $request->city_id,
            'is_active' => $request->has('is_active')
        ]);

        foreach ($request->translations ?? [] as $locale => $data) {
            foreach ($data as $key => $value) {
                if ($value) {
                    $district->translations()->create([
                        'locale' => $locale,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }
        }

        return redirect()->route('admin.districts.index')->with('success', __('districts.created_successfully'));
    }

    public function edit(District $district)
    {
        $languages = Language::active()->orderBy('position')->get();
        $cities = City::where('is_active', true)->get();
        return view('admin.districts.edit', compact('district', 'languages', 'cities'));
    }

    public function update(Request $request, District $district)
    {
        $district->update([
            'city_id' => $request->city_id,
            'is_active' => $request->has('is_active')
        ]);

        $district->translations()->delete();

        foreach ($request->translations ?? [] as $locale => $data) {
            foreach ($data as $key => $value) {
                if ($value) {
                    $district->translations()->create([
                        'locale' => $locale,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }
        }

        return redirect()->route('admin.districts.index')->with('success', __('districts.updated_successfully'));
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('admin.districts.index')->with('success', __('districts.deleted_successfully'));
    }
}
