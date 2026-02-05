<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    /** @use HasFactory<\Database\Factories\FlightFactory> */
    use HasFactory;

    protected $fillable = [
        'location_id',
        'airline',
        'origin',
        'destiny',
        'departure_date',
        'arrival_date',
        'price',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}