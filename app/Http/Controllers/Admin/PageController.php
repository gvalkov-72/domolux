<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('sort_order')->paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $languages = Language::where('is_active', true)->orderBy('position')->get();
        return view('admin.pages.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $languages = Language::where('is_active', true)->pluck('code')->toArray();

        $rules = [
            'slug' => 'required|unique:pages,slug',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ];

        // Добавяме правила за задължителни title и content за всеки активен език
        foreach ($languages as $lang) {
            $rules["title.$lang"] = 'required|string|max:255';
            $rules["content.$lang"] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        $page = new Page();
        $page->slug = $validated['slug'];
        $page->seo_title = $request->input('seo_title');
        $page->seo_description = $request->input('seo_description');
        $page->is_active = $request->has('is_active') ? true : false;
        $page->sort_order = $request->input('sort_order', 0);

        // Вкарваме данни за кой създава
        $page->created_by = Auth::id();
        $page->updated_by = Auth::id();

        $page->save();

        // Записваме преводите (title, content)
        foreach ($languages as $lang) {
            $page->setTranslation('title', $lang, $request->input("title.$lang"));
            $page->setTranslation('content', $lang, $request->input("content.$lang"));
        }

        $page->save();

        return redirect()->route('admin.pages.index')->with('success', __('pages.created_success'));
    }

    public function edit(Page $page)
    {
        $languages = Language::where('is_active', true)->orderBy('position')->get();
        return view('admin.pages.edit', compact('page', 'languages'));
    }

    public function update(Request $request, Page $page)
    {
        $languages = Language::where('is_active', true)->pluck('code')->toArray();

        $rules = [
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ];

        foreach ($languages as $lang) {
            $rules["title.$lang"] = 'required|string|max:255';
            $rules["content.$lang"] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        $page->slug = $validated['slug'];
        $page->seo_title = $request->input('seo_title');
        $page->seo_description = $request->input('seo_description');
        $page->is_active = $request->has('is_active') ? true : false;
        $page->sort_order = $request->input('sort_order', 0);

        $page->updated_by = Auth::id();

        // Записваме преводите (title, content)
        foreach ($languages as $lang) {
            $page->setTranslation('title', $lang, $request->input("title.$lang"));
            $page->setTranslation('content', $lang, $request->input("content.$lang"));
        }

        $page->save();

        return redirect()->route('admin.pages.index')->with('success', __('pages.updated_success'));
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', __('pages.deleted_success'));
    }
}
