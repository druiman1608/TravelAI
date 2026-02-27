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
    public function calculatePrice($data)
    {
        $price = 0;
        if (!empty($data['package_id'])) $price += Package::findOrFail($data['package_id'])->total_price;
        if (!empty($data['hotel_id'])) $price += Hotel::findOrFail($data['hotel_id'])->price_per_night;
        if (!empty($data['flight_id'])) $price += Flight::findOrFail($data['flight_id'])->price;
        if (!empty($data['activity_id'])) $price += Activity::findOrFail($data['activity_id'])->price;

        return Auth::user()->isPremium() ? $price * 0.85 : $price;
    }

    public function store($data)
    {
        return Reservation::create(array_merge($data, [
            'user_id' => Auth::id(),
            'price' => $this->calculatePrice($data),
            'status' => 'pendiente'
        ]));
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelada']);
        return $reservation->delete();
    }
}