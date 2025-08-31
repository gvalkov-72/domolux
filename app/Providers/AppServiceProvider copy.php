<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Translation\Translator;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Filesystem\Filesystem;

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
    }
}
