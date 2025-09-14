<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionItem;
use App\Models\Section;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionItemController extends Controller
{
    public function index()
    {
        $items = SectionItem::with('section')->orderBy('position')->get();
        return view('admin.section_items.index', compact('items'));
    }

    public function create()
    {
        $sections = Section::orderBy('position')->get();
        $languages = Language::where('is_active', 1)
            ->orderBy('position')
            ->get();
        return view('admin.section_items.create', compact('sections','languages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'url' => 'nullable|string|max:1000',
            'position' => 'nullable|integer',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('section_items', 'public');
        }

        $item = SectionItem::create($data);
        $item->fillTranslations($request->input('translations', []));

        return redirect()->route('admin.section_items.index')->with('success', 'Елементът е създаден.');
    }

    public function edit(SectionItem $section_item)
    {
        $sections = Section::orderBy('position')->get();
        $languages = Language::where('is_active', 1)
            ->orderBy('position')
            ->get();
        return view('admin.section_items.edit', ['sectionItem' => $section_item, 'sections' => $sections, 'languages' => $languages]);
    }

    public function update(Request $request, SectionItem $section_item)
    {
        $data = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'url' => 'nullable|string|max:1000',
            'position' => 'nullable|integer',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($section_item->image) {
                Storage::disk('public')->delete($section_item->image);
            }
            $data['image'] = $request->file('image')->store('section_items', 'public');
        }

        $section_item->update($data);
        $section_item->fillTranslations($request->input('translations', []));

        return redirect()->route('admin.section_items.index')->with('success', 'Елементът е обновен.');
    }

    public function destroy(SectionItem $section_item)
    {
        if ($section_item->image) {
            Storage::disk('public')->delete($section_item->image);
        }
        $section_item->deleteTranslations();
        $section_item->delete();

        return redirect()->route('admin.section_items.index')->with('success', 'Елементът е изтрит.');
    }
}
