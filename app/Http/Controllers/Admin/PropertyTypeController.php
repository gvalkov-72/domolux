<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function index()
    {
        $propertyTypes = PropertyType::latest()->paginate(20);
        return view('admin.property_types.index', compact('propertyTypes'));
    }

    public function create()
    {
        $languages = Language::active()->orderBy('position')->get();
        return view('admin.property_types.create', compact('languages'));
    }

    public function store(Request $request)
    {
        // Корекция: преобразуване на is_active
        $data = [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        $propertyType = PropertyType::create($data);

        if ($request->has('translations')) {
            foreach ($request->translations as $locale => $translation) {
                foreach ($translation as $key => $value) {
                    if ($value) {
                        $propertyType->translations()->create([
                            'locale' => $locale,
                            'key' => $key,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.property_types.index')->with('success', __('property_types.created'));
    }

    public function edit(PropertyType $propertyType)
    {
        $languages = Language::active()->orderBy('position')->get();
        return view('admin.property_types.edit', compact('propertyType', 'languages'));
    }

    public function update(Request $request, PropertyType $propertyType)
    {
        // Корекция: преобразуване на is_active
        $data = [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        $propertyType->update($data);

        $propertyType->translations()->delete();

        if ($request->has('translations')) {
            foreach ($request->translations as $locale => $translation) {
                foreach ($translation as $key => $value) {
                    if ($value) {
                        $propertyType->translations()->create([
                            'locale' => $locale,
                            'key' => $key,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.property_types.index')->with('success', __('property_types.updated'));
    }

    public function destroy(PropertyType $propertyType)
    {
        $propertyType->translations()->delete();
        $propertyType->delete();

        return redirect()->route('admin.property_types.index')->with('success', __('property_types.deleted'));
    }
}
