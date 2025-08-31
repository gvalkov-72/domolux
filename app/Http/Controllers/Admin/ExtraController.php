<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use App\Models\Language;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function index()
    {
        $extras = Extra::latest()->paginate(20);
        return view('admin.extras.index', compact('extras'));
    }

    public function create()
    {
        $languages = Language::active()->orderBy('position')->get();
        return view('admin.extras.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $data = [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        $extra = Extra::create($data);

        if ($request->has('translations')) {
            foreach ($request->translations as $locale => $translation) {
                foreach ($translation as $key => $value) {
                    if ($value) {
                        $extra->translations()->create([
                            'locale' => $locale,
                            'key' => $key,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.extras.index')->with('success', __('extras.created'));
    }

    public function edit(Extra $extra)
    {
        $languages = Language::active()->orderBy('position')->get();
        return view('admin.extras.edit', compact('extra', 'languages'));
    }

    public function update(Request $request, Extra $extra)
    {
        $extra->update([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $extra->translations()->delete();

        if ($request->has('translations')) {
            foreach ($request->translations as $locale => $translation) {
                foreach ($translation as $key => $value) {
                    if ($value) {
                        $extra->translations()->create([
                            'locale' => $locale,
                            'key' => $key,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.extras.index')->with('success', __('extras.updated'));
    }

    public function destroy(Extra $extra)
    {
        $extra->translations()->delete();
        $extra->delete();

        return redirect()->route('admin.extras.index')->with('success', __('extras.deleted'));
    }
}
