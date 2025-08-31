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
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with(['propertyType', 'city', 'district', 'location', 'extras'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $propertyTypes   = PropertyType::all();
        $countries       = Country::all();
        $cities          = City::all();
        $districts       = District::all();
        $locations       = Location::all();
        $extras          = Extra::all();
        $activeLanguages = Language::where('is_active', 1)->get();

        return view('admin.properties.create', compact(
            'propertyTypes','countries','cities','districts','locations','extras','activeLanguages'
        ));
    }

    public function store(Request $request)
    {
        $normalizedIds = $this->normalizeIds($request);

        $request->merge($normalizedIds);
        $request->validate([
            'code'             => 'required|unique:properties,code',
            'price'            => 'required|numeric|min:0',
            'property_type_id' => 'required|exists:property_types,id',
            'country_id'       => 'required|exists:countries,id',
            'city_id'          => 'required|exists:cities,id',
            'district_id'      => 'nullable|exists:districts,id',
            'location_id'      => 'nullable|exists:locations,id',
            'area'             => 'nullable|numeric',
            'rooms'            => 'nullable|numeric',
            'floor'            => 'nullable|numeric',
            'email'            => 'nullable|email',
        ]);

        $data = [
            'user_id'          => Auth::id(),
            'code'             => strtoupper(\Illuminate\Support\Str::random(8)),
            'price'            => $request->input('price'),
            'property_type_id' => $request->input('property_type_id'),
            'country_id'       => $request->input('country_id'),
            'city_id'          => $request->input('city_id'),
            'district_id'      => $request->input('district_id'),
            'location_id'      => $request->input('location_id'),
            'area'             => $request->input('area'),
            'rooms'            => $request->input('rooms'),
            'floor'            => $request->input('floor'),
            'phone'            => $request->input('phone'),
            'email'            => $request->input('email'),
            'is_active'        => $request->boolean('is_active'),
        ];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('properties', 'public');
        }

        $property = Property::create($data);

        $activeLangCodes = Language::where('is_active', 1)->pluck('code')->toArray();
        foreach ($activeLangCodes as $lang) {
            $property->setTranslation('title',       $lang, (string)$request->input("title.$lang", ''));
            $property->setTranslation('description', $lang, (string)$request->input("description.$lang", ''));
            $property->setTranslation('offer_type',  $lang, (string)$request->input("offer_type.$lang", ''));
            $property->setTranslation('address',     $lang, (string)$request->input("address.$lang", ''));
        }
        $property->save();

        $extrasIds = $this->flattenExtras($request->input('extras', []));
        $property->extras()->sync($extrasIds);

        return redirect()->route('admin.properties.index')
            ->with('success', __('properties.created'));
    }

    public function edit(Property $property)
    {
        $property->load(['extras', 'propertyType', 'city', 'district', 'location']);

        $propertyTypes   = PropertyType::all();
        $countries       = Country::all();
        $cities          = City::all();
        $districts       = District::all();
        $locations       = Location::all();
        $extras          = Extra::all();
        $activeLanguages = Language::where('is_active', 1)->get();

        return view('admin.properties.edit', compact(
            'property','propertyTypes','countries','cities','districts','locations','extras','activeLanguages'
        ));
    }

    public function update(Request $request, Property $property)
    {
        $normalizedIds = $this->normalizeIds($request);

        $request->merge($normalizedIds);
        $request->validate([
            'code'             => ['required', Rule::unique('properties','code')->ignore($property->id)],
            'price'            => 'required|numeric|min:0',
            'property_type_id' => 'required|exists:property_types,id',
            'country_id'       => 'required|exists:countries,id',
            'city_id'          => 'required|exists:cities,id',
            'district_id'      => 'nullable|exists:districts,id',
            'location_id'      => 'nullable|exists:locations,id',
            'area'             => 'nullable|numeric',
            'rooms'            => 'nullable|numeric',
            'floor'            => 'nullable|numeric',
            'email'            => 'nullable|email',
        ]);

        $data = [
            'user_id'          => Auth::id(),
            'code'             => $request->input('code'),
            'price'            => $request->input('price'),
            'property_type_id' => $request->input('property_type_id'),
            'country_id'       => $request->input('country_id'),
            'city_id'          => $request->input('city_id'),
            'district_id'      => $request->input('district_id'),
            'location_id'      => $request->input('location_id'),
            'area'             => $request->input('area'),
            'rooms'            => $request->input('rooms'),
            'floor'            => $request->input('floor'),
            'phone'            => $request->input('phone'),
            'email'            => $request->input('email'),
            'is_active'        => $request->boolean('is_active'),
        ];

        if ($request->hasFile('cover_image')) {
            if ($property->cover_image && Storage::disk('public')->exists($property->cover_image)) {
                Storage::disk('public')->delete($property->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('properties', 'public');
        }

        $property->update($data);

        $activeLangCodes = Language::where('is_active', 1)->pluck('code')->toArray();
        foreach ($activeLangCodes as $lang) {
            $property->setTranslation('title',       $lang, (string)$request->input("title.$lang", ''));
            $property->setTranslation('description', $lang, (string)$request->input("description.$lang", ''));
            $property->setTranslation('offer_type',  $lang, (string)$request->input("offer_type.$lang", ''));
            $property->setTranslation('address',     $lang, (string)$request->input("address.$lang", ''));
        }
        $property->save();

        $extrasIds = $this->flattenExtras($request->input('extras', []));
        $property->extras()->sync($extrasIds);

        return redirect()->route('admin.properties.index')
            ->with('success', __('properties.updated'));
    }

    public function destroy(Property $property)
    {
        if ($property->cover_image && Storage::disk('public')->exists($property->cover_image)) {
            Storage::disk('public')->delete($property->cover_image);
        }

        $property->extras()->detach();
        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', __('properties.deleted'));
    }

    private function pickFirstId($value)
    {
        if (is_array($value)) {
            foreach ($value as $v) {
                if ($v !== null && $v !== '') {
                    return $v;
                }
            }
            return null;
        }
        return $value;
    }

    private function normalizeIds(Request $request): array
    {
        return [
            'property_type_id' => $this->pickFirstId($request->input('property_type_id')),
            'country_id'       => $this->pickFirstId($request->input('country_id')),
            'city_id'          => $this->pickFirstId($request->input('city_id')),
            'district_id'      => $this->pickFirstId($request->input('district_id')),
            'location_id'      => $this->pickFirstId($request->input('location_id')),
        ];
    }

    private function flattenExtras($extrasByLang): array
    {
        if (!is_array($extrasByLang)) {
            return [];
        }

        $ids = [];
        foreach ($extrasByLang as $arr) {
            if (is_array($arr)) {
                foreach ($arr as $id) {
                    if ($id !== null && $id !== '') {
                        $ids[] = (int) $id;
                    }
                }
            }
        }

        return array_values(array_unique($ids));
    }
}
