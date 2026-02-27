<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthApiController,
    ActivityApiController,
    AIChatLogApiController,
    FlightApiController,
    HotelApiController,
    LocationApiController,
    PackageApiController,
    ReservationApiController,
    ReviewApiController,
    RoleApiController,
    UserApiController,
    UserPreferenceApiController
};

// Ruta de Login
Route::post('/login', [AuthApiController::class, 'login'])->name('api.login');

// Rutas Protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return new \App\Http\Resources\UserResource($request->user());
    })->name('api.user');

    Route::apiResource('activities', ActivityApiController::class)->names('api.activities');
    Route::apiResource('chatlogs', AIChatLogApiController::class)->names('api.chatlogs');
    Route::apiResource('flights', FlightApiController::class)->names('api.flights');
    Route::apiResource('hotels', HotelApiController::class)->names('api.hotels');
    Route::apiResource('locations', LocationApiController::class)->names('api.locations');
    Route::apiResource('packages', PackageApiController::class)->names('api.packages');
    Route::apiResource('reservations', ReservationApiController::class)->names('api.reservations');
    Route::apiResource('reviews', ReviewApiController::class)->names('api.reviews');
    Route::apiResource('preferences', UserPreferenceApiController::class)->names('api.preferences');
    Route::apiResource('roles', RoleApiController::class)->names('api.roles');
    Route::apiResource('users', UserApiController::class)->names('api.users');

    Route::post('/logout', [AuthApiController::class, 'logout'])->name('api.logout');
});