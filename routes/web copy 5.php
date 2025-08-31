<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyImageController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ExtraController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DistrictController;

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
        | Ресурси
        |--------------------------------------------------------------------------
        */

        // Езици
        Route::resource('languages', LanguageController::class);
        Route::post('languages/sort', [LanguageController::class, 'sort'])->name('languages.sort');
        Route::post('languages/move', [LanguageController::class, 'move'])->name('languages.move');

        // Държави
        Route::resource('countries', CountryController::class);
        // Градове
        Route::resource('cities', CityController::class);
        // Квартали
        Route::resource('districts', DistrictController::class);
        // Локационна йерархия
        Route::resource('locations', LocationController::class);
        // Имоти
        Route::resource('properties', PropertyController::class);
        // Галерия на имоти
        Route::resource('property-images', PropertyImageController::class)->except(['create', 'edit']);
        Route::post('property-images/sort', [PropertyImageController::class, 'sort'])->name('property-images.sort');
        Route::delete('property-images/{id}', [PropertyImageController::class, 'destroy'])->name('property-images.destroy');
        // Екстри
        Route::resource('extras', ExtraController::class);
    });
});
