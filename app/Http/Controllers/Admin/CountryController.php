<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Language;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::latest()->paginate(20);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        $languages = Language::active()->orderBy('position')->get();
        return view('admin.countries.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:countries,code',
        ]);

        $country = Country::create([
            'code' => $request->code,
            'is_active' => $request->boolean('is_active'),
        ]);

        foreach ($request->input('translations', []) as $locale => $translation) {
            if (!empty($translation['name'])) {
                $country->translations()->create([
                    'locale' => $locale,
                    'key' => 'name',
                    'value' => $translation['name'],
                ]);
            }
        }

        return redirect()->route('admin.countries.index')->with('success', __('countries.created_successfully'));
    }

    public function edit(Country $country)
    {
        $languages = Language::active()->orderBy('position')->get();
        return view('admin.countries.edit', compact('country', 'languages'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:countries,code,' . $country->id,
        ]);

        $country->update([
            'code' => $request->code,
            'is_active' => $request->boolean('is_active'),
        ]);

        foreach ($request->input('translations', []) as $locale => $translation) {
            $country->setTranslation('name', $locale, $translation['name'] ?? '');
        }

        return redirect()->route('admin.countries.index')->with('success', __('countries.updated_successfully'));
    }

    public function destroy(Country $country)
    {
        $country->translations()->delete();
        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', __('countries.deleted_successfully'));
    }
}
