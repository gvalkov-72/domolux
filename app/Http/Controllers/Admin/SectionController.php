<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Language;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('position')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        $languages = Language::where('is_active', 1)
            ->orderBy('position')
            ->get();
        return view('admin.sections.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string|max:100',
            'key' => 'nullable|string|max:150|unique:sections,key',
            'position' => 'nullable|integer',
            'settings' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        if ($request->filled('settings') && is_string($request->settings)) {
            // Ако подадат JSON в полето settings — опитай да го декодираш (иначе остави като string)
            $decoded = json_decode($request->settings, true);
            $data['settings'] = $decoded === null ? $request->settings : $decoded;
        }

        $section = Section::create($data);
        $section->fillTranslations($request->input('translations', []));

        return redirect()->route('admin.sections.index')->with('success', 'Секцията е създадена.');
    }

    public function edit(Section $section)
    {
        $languages = Language::where('is_active', 1)
            ->orderBy('position')
            ->get();
        return view('admin.sections.edit', compact('section','languages'));
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'type' => 'required|string|max:100',
            'key' => 'nullable|string|max:150|unique:sections,key,'.$section->id,
            'position' => 'nullable|integer',
            'settings' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        if ($request->filled('settings') && is_string($request->settings)) {
            $decoded = json_decode($request->settings, true);
            $data['settings'] = $decoded === null ? $request->settings : $decoded;
        }

        $section->update($data);
        $section->fillTranslations($request->input('translations', []));

        return redirect()->route('admin.sections.index')->with('success', 'Секцията е обновена.');
    }

    public function destroy(Section $section)
    {
        // изтрий преводите и елементите
        $section->deleteTranslations();
        foreach ($section->items as $item) {
            $item->deleteTranslations();
            if ($item->image) \Illuminate\Support\Facades\Storage::disk('public')->delete($item->image);
            $item->delete();
        }
        $section->delete();

        return redirect()->route('admin.sections.index')->with('success', 'Секцията е изтрита.');
    }
}
