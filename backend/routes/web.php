<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    HotelController,
    FlightController,
    PackageController,
    ActivityController,
    UserController,
    ReservationController,
    ReviewController,
    RoleController,
    UserPreferenceController,
    AIChatLogController,
    LocationController
};

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ### Rutas para el admin y su CRUD ###
    Route::middleware('admin')->group(function () {
        // [Hoteles, Vuelos, Paquetes y Actividades]
        Route::resource('hotels', HotelController::class)->except(['index', 'show']);
        Route::resource('flights', FlightController::class)->except(['index', 'show']);
        Route::resource('packages', PackageController::class)->except(['index', 'show']);
        Route::resource('activities', ActivityController::class)->except(['index', 'show']);

        // [Usuarios, Roles y Localizaciones]
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('locations', LocationController::class);

        // [Logs de la IA - Borrado admin]
        Route::delete('/ai-logs/{log}', [AIChatLogController::class, 'destroy'])->name('aichatlogs.destroy');
    });

    // ### Rutas publicas para usuarios logeados ###

    // [Catalogo de los servicios]
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

    Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
    Route::get('/flights/{flight}', [FlightController::class, 'show'])->name('flights.show');

    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');

    // [Reservas y reseñas]
    Route::resource('reservations', ReservationController::class);
    Route::resource('reviews', ReviewController::class);

    // [Chat con IA]
    Route::get('/ai-logs', [AIChatLogController::class, 'index'])->name('aichatlogs.index');
    Route::get('/ai-logs/{aichatlog}', [AIChatLogController::class, 'show'])->name('aichatlogs.show');
    Route::get('/ai-chat/create', [AIChatLogController::class, 'create'])->name('aichatlogs.create');
    Route::post('/ai-chat/store', [AIChatLogController::class, 'store'])->name('aichatlogs.store');

    // [Preferencias del Usuario]
    Route::get('/user-preferences', [UserPreferenceController::class, 'index'])->name('userPreferences.index');
    Route::post('/user-preferences', [UserPreferenceController::class, 'store'])->name('userPreferences.store');
    Route::delete('/user-preferences/{userPreference}', [UserPreferenceController::class, 'destroy'])->name('userPreferences.destroy');
});