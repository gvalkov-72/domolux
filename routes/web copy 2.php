<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyImageController;

Route::get('/', function () {
    return redirect()->route('dashboard'); // или 'login' ако искаш
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Потребители (всички роли имат достъп)
    Route::resource('users', UserController::class);

    Route::middleware(['auth'])->group(function () {
        Route::resource('roles', RoleController::class);
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('permissions', PermissionController::class);
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('languages', LanguageController::class);

        Route::post('languages/sort', [LanguageController::class, 'sort'])->name('languages.sort');
        Route::post('languages/move', [LanguageController::class, 'move'])->name('languages.move');
    });

    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('properties', PropertyController::class);
    });
});
