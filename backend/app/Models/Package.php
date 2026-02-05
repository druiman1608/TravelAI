<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'hotel_id',
        'flight_id',
        'activity_id',
        'total_price',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
