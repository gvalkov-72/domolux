<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyImageController;
use App\Http\Controllers\Admin\ExtraController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController as FrontendLanguageController;
use UniSharp\LaravelFilemanager\Lfm;



/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Админ зона
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    // Табло
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Потребители, роли, права
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    // Езици
    Route::resource('languages', LanguageController::class);
    Route::post('languages/sort', [LanguageController::class, 'sort'])->name('languages.sort');
    Route::post('languages/move', [LanguageController::class, 'move'])->name('languages.move');

    // Държави, градове, квартали, локации, типове имоти
    Route::resource('countries', CountryController::class);
    Route::resource('cities', CityController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('property_types', PropertyTypeController::class);

    // Имоти
    Route::resource('properties', PropertyController::class);

    // Снимки към имоти (nested resource)
    Route::resource('properties.images', PropertyImageController::class);



    // Екстри и страници
    Route::resource('extras', ExtraController::class);
    Route::resource('pages', PageController::class);

    // Upload изображения
    Route::post('upload/image', [UploadController::class, 'uploadImage'])->name('upload.image');

    // Секции
    Route::resource('sections', \App\Http\Controllers\Admin\SectionController::class);

    // Елементи на секция
    Route::resource('section_items', \App\Http\Controllers\Admin\SectionItemController::class);

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        Lfm::routes();
    });
});

/*
|--------------------------------------------------------------------------
| Фронтенд начална страница
|--------------------------------------------------------------------------
*/
Route::middleware(['web', \App\Http\Middleware\SetSiteLanguage::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

    /*
    |--------------------------------------------------------------------------
    | Фронтенд смяна на език
    |--------------------------------------------------------------------------
    */
    Route::get('lang/{code}', [FrontendLanguageController::class, 'switch'])
        ->name('frontend.language.switch');

    /*
    |--------------------------------------------------------------------------
    | Фронтенд динамични страници
    |--------------------------------------------------------------------------
    */
    Route::get('/{slug}', [FrontendPageController::class, 'show'])
        ->where('slug', '^[a-zA-Z0-9-_]+$')
        ->name('frontend.page.show');
});
