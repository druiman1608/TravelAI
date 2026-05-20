<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class ReservationService
{
    public function calculatePrice(array $data): float
    {
        $price = 0.0;
        if (!empty($data['package_id'])) $price += Package::findOrFail($data['package_id'])->total_price;
        if (!empty($data['hotel_id'])) {
            $nights = $data['total_nights'] ?? 1;
            $price += Hotel::findOrFail($data['hotel_id'])->price_per_night * $nights;
        }
        if (!empty($data['flight_id'])) $price += Flight::findOrFail($data['flight_id'])->price;
        if (!empty($data['activity_id'])) $price += Activity::findOrFail($data['activity_id'])->price;

        return Auth::user()->isPremium() ? $price * 0.90 : $price;
    }

    public function store(array $data): Reservation
    {
        return Reservation::create(array_merge($data, [
            'user_id' => Auth::id(),
            'total_price' => $this->calculatePrice($data),
            'status' => 'pending'
        ]));
    }

    public function cancel(Reservation $reservation): Reservation
    {
        $reservation->update(['status' => 'cancelled']);
        return $reservation;
    }
}