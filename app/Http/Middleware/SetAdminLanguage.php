<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Models\Language;

class SetAdminLanguage
{
    public function handle($request, Closure $next)
    {
        if (Schema::hasTable('languages')) {
            // Проверка дали вече има избран език в сесията
            $locale = Session::get('admin_locale');

            if (!$locale) {
                // Ако няма — зареждаме default от базата
                $language = Language::where('is_default_admin', true)->first();
                $locale = $language?->code ?? config('app.locale');

                // Записваме в сесията
                Session::put('admin_locale', $locale);
            }

            // Прилагаме езика
            App::setLocale($locale);
        }

        return $next($request);
    }
}
