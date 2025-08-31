<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyImageController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ExtraController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {

        /*
    |--------------------------------------------------------------------------
    | Обща администрация (потребители, роли, права)
    |--------------------------------------------------------------------------
    */
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        /*
    |--------------------------------------------------------------------------
    | Група за админски ресурси
    |--------------------------------------------------------------------------
    */

        // Езици
        Route::resource('languages', LanguageController::class);
        Route::post('languages/sort', [LanguageController::class, 'sort'])->name('languages.sort');
        Route::post('languages/move', [LanguageController::class, 'move'])->name('languages.move');

        // Имоти
        Route::resource('properties', PropertyController::class);

        // Типове имоти
        Route::resource('property_types', PropertyTypeController::class)->except(['show']);

        // Локации
       // Route::resource('locations', LocationController::class);

        // Екстри
        Route::resource('extras', ExtraController::class);

        // Снимки на имоти (по избор - ако ти трябва галерия)
        //Route::delete('property-images/{id}', [PropertyImageController::class, 'destroy'])->name('property-images.destroy');
    });
});
