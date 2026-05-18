<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthApiController,
    ActivityApiController,
    AIChatLogApiController,
    FlightApiController,
    FlightOfferApiController,
    HotelApiController,
    LocationApiController,
    PackageApiController,
    ReservationApiController,
    ReviewApiController,
    RoleApiController,
    UserApiController,
    UserPreferenceApiController,
    PassengerApiController,
    HotelRoomApiController,
    PaymentApiController
};

Route::post('/login', [AuthApiController::class, 'login'])->middleware('throttle:10,1')->name('api.login');
Route::post('/register', [AuthApiController::class, 'register'])->middleware('throttle:5,1')->name('api.register');
Route::post('/auth/google', [AuthApiController::class, 'googleLogin'])->middleware('throttle:10,1');

Route::get('/flight-offers', [FlightOfferApiController::class, 'index']);
Route::get('/flight-offers/{id}', [FlightOfferApiController::class, 'show']);
Route::get('/hotels', [HotelApiController::class, 'index']);
Route::get('/hotels/{id}', [HotelApiController::class, 'show']);
Route::get('/flights', [FlightApiController::class, 'index']);
Route::get('/packages', [PackageApiController::class, 'index']);
Route::get('/packages/{id}', [PackageApiController::class, 'show']);
Route::get('/activities', [ActivityApiController::class, 'index']);
Route::get('/activities/{id}', [ActivityApiController::class, 'show']);
Route::get('/locations', [LocationApiController::class, 'index']);

Route::get('/reviews', [ReviewApiController::class, 'index']);
Route::get('/reviews/{id}', [ReviewApiController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/payment/intent', [PaymentApiController::class, 'createPaymentIntent']);
    Route::post('/payment/confirm-reservation', [PaymentApiController::class, 'confirmReservation']);

    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::delete('/user/me', [UserApiController::class, 'destroyMe']);
    Route::get('/user/profile-summary', [AuthApiController::class, 'user']);

    Route::apiResource('reservations', ReservationApiController::class);
    Route::get('/preferences', [UserPreferenceApiController::class, 'showMe']);
    Route::post('/preferences', [UserPreferenceApiController::class, 'store']);
    Route::apiResource('passengers', PassengerApiController::class);
    Route::apiResource('chatlogs', AIChatLogApiController::class)->only(['index', 'store', 'show']);

    Route::apiResource('reviews', ReviewApiController::class)->only(['store', 'update', 'destroy']);
    Route::get('/my-reviews', [ReviewApiController::class, 'userReviews']);

    Route::put('/user/update', [UserApiController::class, 'updateMe']);
    Route::post('/user/upload-avatar', [UserApiController::class, 'uploadAvatar']);
    Route::post('/user/become-premium', [UserApiController::class, 'becomePremium']);

    Route::middleware('role:admin,mod')->group(function () {
        Route::get('/admin/reviews/pending', [ReviewApiController::class, 'pendingReviews']);
        Route::patch('/admin/reviews/{id}/status', [ReviewApiController::class, 'updateStatus']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::apiResource('flights', FlightApiController::class)->except(['index', 'show']);
        Route::apiResource('flight-offers', FlightOfferApiController::class)->except(['index', 'show']);
        Route::apiResource('hotels', HotelApiController::class)->except(['index', 'show']);
        Route::apiResource('activities', ActivityApiController::class)->except(['index', 'show']);
        Route::apiResource('packages', PackageApiController::class)->except(['index', 'show']);
        Route::apiResource('hotel-rooms', HotelRoomApiController::class);
        Route::apiResource('users', UserApiController::class);
        Route::apiResource('roles', RoleApiController::class)->only(['index', 'show']);
        Route::apiResource('locations', LocationApiController::class)->except(['index']);
    });
});