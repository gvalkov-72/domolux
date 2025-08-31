<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Language;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with('district')->latest()->paginate(20);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        $languages = Language::active()->orderBy('position')->get();
        $districts = District::where('is_active', true)->get();
        return view('admin.locations.create', compact('languages', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'is_active' => 'nullable|boolean',
        ]);

        $location = Location::create([
            'district_id' => $request->district_id,
            'is_active' => $request->boolean('is_active'),
        ]);

        foreach ($request->input('translations', []) as $locale => $fields) {
            foreach ($fields as $key => $value) {
                if ($value) {
                    $location->translations()->create([
                        'locale' => $locale,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }
        }

        return redirect()->route('admin.locations.index')->with('success', __('messages.created_successfully'));
    }

    public function edit(Location $location)
    {
        $languages = Language::active()->orderBy('position')->get();
        $districts = District::where('is_active', true)->get();
        return view('admin.locations.edit', compact('location', 'languages', 'districts'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'is_active' => 'nullable|boolean',
        ]);

        $location->update([
            'district_id' => $request->district_id,
            'is_active' => $request->boolean('is_active'),
        ]);

        foreach ($request->input('translations', []) as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $location->translations()->updateOrCreate([
                    'locale' => $locale,
                    'key' => $key,
                ], [
                    'value' => $value,
                ]);
            }
        }

        return redirect()->route('admin.locations.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', __('messages.deleted_successfully'));
    }
}
