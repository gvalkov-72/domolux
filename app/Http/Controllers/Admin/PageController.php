<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Списък със страници
     */
    public function index()
    {
        $pages = Page::orderBy('sort_order')->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Форма за създаване
     */
    public function create()
    {
        $languages = Language::orderBy('position')->get();
        return view('admin.pages.create', compact('languages'));
    }

    /**
     * Записване на нова страница
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:pages,slug',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'template' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $data['created_by'] = Auth::id();
        $data['author_id'] = Auth::id();

        $page = Page::create($data);

        // Запис на преводими полета
        foreach ($request->input('translations', []) as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $page->setTranslation($key, $locale, $value);
            }
        }
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Страницата е създадена успешно.');
    }

    /**
     * Форма за редакция
     */
    public function edit(Page $page)
    {
        $languages = Language::orderBy('position')->get();
        return view('admin.pages.edit', compact('page', 'languages'));
    }

    /**
     * Обновяване
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:pages,slug,' . $page->id,
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'template' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $data['updated_by'] = Auth::id();

        $page->update($data);

        foreach ($request->input('translations', []) as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $page->setTranslation($key, $locale, $value);
            }
        }
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Страницата е обновена успешно.');
    }

    /**
     * Изтриване
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Страницата е изтрита успешно.');
    }
}
