<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Translation\Translator;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\View;
use App\View\Composers\AdminMenuComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Регистрация на TranslationServiceProvider
        $this->app->register(TranslationServiceProvider::class);

        // Alias за translator (за IDE и някои пакети)
        $this->app->alias('translator', Translator::class);

        // Регистрация на файловия мениджър
        $this->app->singleton('files', function ($app) {
            return new Filesystem();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    Schema::defaultStringLength(191);

    // Зареждане на преведено меню точно преди рендер на AdminLTE
    View::composer('adminlte::page', AdminMenuComposer::class);
}
}
