<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyImage;
use App\Models\Property;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    public function index()
    {
        $images = PropertyImage::with('property')->paginate(15);
        $activeLanguages = Language::where('is_active', true)->pluck('code')->toArray();
        return view('admin.property_images.index', compact('images', 'activeLanguages'));
    }

    public function create()
    {
        $properties = Property::all();
        $activeLanguages = Language::where('is_active', true)->pluck('code')->toArray();
        return view('admin.property_images.create', compact('properties', 'activeLanguages'));
    }

    public function store(Request $request)
    {
        $activeLanguages = Language::where('is_active', true)->pluck('code')->toArray();

        $rules = [
            'property_id' => ['required', 'exists:properties,id'],
            'image' => ['required', 'image', 'max:5120'],
        ];

        foreach ($activeLanguages as $code) {
            $rules["description.$code"] = ['nullable', 'string'];
        }

        $validated = $request->validate($rules);

        $imagePath = $request->file('image')->store('property_images', 'public');

        $image = new PropertyImage();
        $image->property_id = $validated['property_id'];
        $image->image_path = $imagePath;

        foreach ($activeLanguages as $code) {
            $image->setTranslation('description', $code, $request->input("description.$code", ''));
        }

        $image->save();

        return redirect()->route('admin.property_images.index')->with('success', 'Снимката беше добавена успешно.');
    }

    public function edit(PropertyImage $propertyImage)
    {
        $properties = Property::all();
        $activeLanguages = Language::where('is_active', true)->pluck('code')->toArray();

        return view('admin.property_images.edit', [
            'image' => $propertyImage,
            'properties' => $properties,
            'activeLanguages' => $activeLanguages,
        ]);
    }

    public function update(Request $request, PropertyImage $propertyImage)
    {
        $activeLanguages = Language::where('is_active', true)->pluck('code')->toArray();

        $rules = [
            'property_id' => ['required', 'exists:properties,id'],
            'image' => ['nullable', 'image', 'max:5120'],
        ];

        foreach ($activeLanguages as $code) {
            $rules["description.$code"] = ['nullable', 'string'];
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($propertyImage->image_path) {
                Storage::disk('public')->delete($propertyImage->image_path);
            }
            $imagePath = $request->file('image')->store('property_images', 'public');
            $propertyImage->image_path = $imagePath;
        }

        $propertyImage->property_id = $validated['property_id'];

        foreach ($activeLanguages as $code) {
            $propertyImage->setTranslation('description', $code, $request->input("description.$code", ''));
        }

        $propertyImage->save();

        return redirect()->route('admin.property_images.index')->with('success', 'Снимката беше обновена успешно.');
    }

    public function destroy(PropertyImage $propertyImage)
    {
        if ($propertyImage->image_path) {
            Storage::disk('public')->delete($propertyImage->image_path);
        }
        $propertyImage->delete();

        return redirect()->route('admin.property_images.index')->with('success', 'Снимката беше изтрита успешно.');
    }
}
