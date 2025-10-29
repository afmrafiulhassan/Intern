<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/car/search', [CarController::class, 'search'])->name('car.search');

Route::middleware('auth')->group(function () {
    Route::resource('car', CarController::class)->except(['show']);
    Route::get('/my-cars', [CarController::class, 'index'])->name('car.myCars');
    Route::get('/car/watchlist', [CarController::class, 'watchlist'])->name('car.watchlist');
    Route::post('/car/{car}/favourite', [FavouriteController::class, 'toggle'])->name('car.favourite');
    Route::delete('/car-images/{carImage}', [CarController::class, 'deleteImage'])->name('car-images.destroy');
    Route::post('/car-images/reorder', [CarController::class, 'reorderImages'])->name('car-images.reorder');
    Route::get('/user/welcome', function () {
        return view('user.welcome');
    })->name('user.welcome');
});

Route::get('/car/{car}', [CarController::class, 'show'])
    ->whereNumber('car')
    ->name('car.show');

Route::middleware('guest')->group(function () {
    Route::get('/signup', [SignupController::class, 'create'])->name('signup');
    Route::post('/signup', [SignupController::class, 'store'])->name('signup.post');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');