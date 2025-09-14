<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Language;

class LanguageController extends Controller
{
    public function switch($code)
    {
        // Проверяваме дали езикът съществува и е активен
        $language = Language::where('code', $code)->where('is_active', true)->first();

        if ($language) {
            // Слагаме в сесията
            Session::put('site_locale', $code);
            App::setLocale($code);
        }

        // Връщаме обратно на предната страница
        return redirect()->back();
    }
}
