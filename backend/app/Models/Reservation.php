<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'hotel_id',
        'flight_id',
        'price',
        'state'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}