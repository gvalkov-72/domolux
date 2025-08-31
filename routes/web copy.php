<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;

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

    // Само администратор има достъп до ролите
    Route::middleware('role:admin')->group(function () {
        Route::resource('roles', RoleController::class);
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('permissions', PermissionController::class);
    });

});
