<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Models\Language;

class SetSiteLanguage
{
    public function handle($request, Closure $next)
    {
        if (Schema::hasTable('languages')) {
            $locale = Session::get('site_locale');

            if (!$locale) {
                // Извличаме езика по подразбиране за сайта
                $language = Language::where('is_default_site', true)->first();
                $locale = $language?->code ?? config('app.locale');
                Session::put('site_locale', $locale);
            }

            App::setLocale($locale);
        }

        return $next($request);
    }
}
