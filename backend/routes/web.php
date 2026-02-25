<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('reservations', ReservationController::class);
    Route::resource('reviews', ReviewController::class);
});

Route::middleware('admin')->group(function () {

    Route::resource('hotels', HotelController::class);
    Route::resource('flights', FlightController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('users', UserController::class);
});