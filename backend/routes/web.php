<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FlightController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    -Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('hotels', HotelController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('admin')->group(function () {
    Route::resource('hotels', HotelController::class)->except(['index', 'show']);
    Route::resource('flights', FlightController::class)->except(['index', 'show']);
});