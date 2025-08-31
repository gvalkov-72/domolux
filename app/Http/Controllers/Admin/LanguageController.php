<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::orderBy('position')->get();
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:languages,code',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_default_admin' => 'boolean',
            'is_default_site' => 'boolean',
        ]);

        if ($request->is_default_admin) {
            Language::where('is_default_admin', true)->update(['is_default_admin' => false]);
        }

        if ($request->is_default_site) {
            Language::where('is_default_site', true)->update(['is_default_site' => false]);
        }

        $position = Language::max('position') + 1;

        Language::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'is_default_admin' => $request->has('is_default_admin'),
            'is_default_site' => $request->has('is_default_site'),
            'position' => $position,
        ]);

        return redirect()->route('admin.languages.index')->with('success', 'Language created successfully.');
    }

    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:languages,code,' . $language->id,
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_default_admin' => 'boolean',
            'is_default_site' => 'boolean',
        ]);

        if ($request->is_default_admin) {
            Language::where('is_default_admin', true)->update(['is_default_admin' => false]);
        }

        if ($request->is_default_site) {
            Language::where('is_default_site', true)->update(['is_default_site' => false]);
        }

        $language->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'is_default_admin' => $request->has('is_default_admin'),
            'is_default_site' => $request->has('is_default_site'),
        ]);

        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->route('admin.languages.index')->with('success', 'Language deleted.');
    }

    public function sort(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Language::where('id', $id)->update(['position' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function move(Request $request)
    {
        $language = Language::findOrFail($request->id);

        if ($request->direction === 'up') {
            $swap = Language::where('position', '<', $language->position)
                ->orderBy('position', 'desc')->first();
        } else {
            $swap = Language::where('position', '>', $language->position)
                ->orderBy('position')->first();
        }

        if ($swap) {
            [$language->position, $swap->position] = [$swap->position, $language->position];
            $language->save();
            $swap->save();
        }

        return response()->json(['status' => 'success']);
    }
}
