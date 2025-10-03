<?php

use Illuminate\Support\Facades\Route;

// Public-site controllers
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\BookingController;

// Admin controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FoodMenuController;
use App\Http\Controllers\Admin\DecorationCategoryController;
use App\Http\Controllers\Admin\MusicCategoryController;

/*
|--------------------------------------------------------------------------
| Public pages
|--------------------------------------------------------------------------
*/
Route::get('/',       [PublicPageController::class, 'home'])->name('home');
Route::get('/menus',  [PublicPageController::class, 'menus'])->name('menus');
Route::get('/decor',  [PublicPageController::class, 'decor'])->name('decor');
Route::get('/music',  [PublicPageController::class, 'music'])->name('music');

/*
|--------------------------------------------------------------------------
| Public booking (no login required)
|--------------------------------------------------------------------------
*/
Route::get('/book-now',  [BookingController::class, 'create'])->name('book.create');
Route::post('/book-now', [BookingController::class, 'store'])->name('book.store');

/*
|--------------------------------------------------------------------------
| Admin area (login + admin role required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','admin'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('food-menus', FoodMenuController::class);
        Route::resource('decorations', DecorationCategoryController::class);
        Route::resource('music', MusicCategoryController::class);
    });

/*
|--------------------------------------------------------------------------
| Auth routes (Breeze)
| Keep login/logout in routes/auth.php. If you don't want public registration,
| comment out the register routes inside routes/auth.php.
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
