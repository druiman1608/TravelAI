<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightOffer extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'outbound_flight_id', 'return_flight_id', 'total_price'];

    public function outboundFlight(): BelongsTo
    {
        return $this->belongsTo(Flight::class, 'outbound_flight_id');
    }

    public function returnFlight(): BelongsTo
    {
        return $this->belongsTo(Flight::class, 'return_flight_id');
    }
}