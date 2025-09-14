<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    /**
     * Списък със снимките за даден имот
     */
    public function index(Property $property)
    {
        $images = $property->images()->orderBy('position')->get();

        return view('admin.property_images.index', compact('property', 'images'));
    }

    /**
     * Форма за качване на нови снимки
     */
    public function create(Property $property)
    {
        return view('admin.property_images.create', compact('property'));
    }

    /**
     * Запазване на качени снимки
     */
    public function store(Request $request, Property $property)
    {
        $request->validate([
            'images.*' => 'required|image|max:5120', // до 5MB на файл
        ]);

        foreach ($request->file('images', []) as $index => $file) {
            $path = $file->store('properties/' . $property->id, 'public');

            $property->images()->create([
                'path' => $path,
                'disk' => 'public',
                'position' => $property->images()->count() + 1,
                'is_cover' => false,
            ]);
        }

        return redirect()->route('admin.properties.images.index', $property)
            ->with('success', __('messages.images_uploaded_success'));
    }

    /**
     * Редактиране (примерно само cover / позиция)
     */
    public function edit(Property $property, PropertyImage $image)
    {
        return view('admin.property_images.edit', compact('property', 'image'));
    }

    /**
     * Обновяване (cover/позиция)
     */
    public function update(Request $request, Property $property, PropertyImage $image)
    {
        $request->validate([
            'is_cover' => 'nullable|boolean',
            'position' => 'nullable|integer',
        ]);

        if ($request->boolean('is_cover')) {
            // зануляваме другите cover
            $property->images()->update(['is_cover' => false]);
        }

        $image->update([
            'is_cover' => $request->boolean('is_cover'),
            'position' => $request->input('position', $image->position),
        ]);

        return redirect()->route('admin.properties.images.index', $property)
            ->with('success', __('messages.image_updated_success'));
    }

    /**
     * Изтриване
     */
    public function destroy(Property $property, PropertyImage $image)
    {
        Storage::disk($image->disk)->delete($image->path);
        $image->delete();

        return redirect()->route('admin.properties.images.index', $property)
            ->with('success', __('messages.image_deleted_success'));
    }
}
