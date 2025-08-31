<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('country')->latest()->paginate(20);
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $languages = Language::active()->orderBy('position')->get();
        $countries = Country::where('is_active', true)->orderBy('code')->get();
        return view('admin.cities.create', compact('languages', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'array',
            'name.*' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $city = City::create([
                'country_id' => $request->country_id,
                'is_active' => $request->boolean('is_active'),
            ]);

            foreach ($request->name ?? [] as $locale => $value) {
                $value = $value ?? '';
                if ($value !== '') {
                    $city->setTranslation('name', $locale, $value);
                }
            }

            $city->save();
        });

        return redirect()->route('admin.cities.index')->with('success', __('cities.created_successfully'));
    }

    public function edit(City $city)
    {
        $languages = Language::active()->orderBy('position')->get();
        $countries = Country::where('is_active', true)->orderBy('code')->get();
        return view('admin.cities.edit', compact('city', 'languages', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'array',
            'name.*' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $city) {
            $city->update([
                'country_id' => $request->country_id,
                'is_active' => $request->boolean('is_active'),
            ]);

            foreach ($request->name ?? [] as $locale => $value) {
                $value = $value ?? '';
                if ($value !== '') {
                    $city->setTranslation('name', $locale, $value);
                }
            }

            $city->save();
        });

        return redirect()->route('admin.cities.index')->with('success', __('cities.updated_successfully'));
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', __('cities.deleted_successfully'));
    }
}
