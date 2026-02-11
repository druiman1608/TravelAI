<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    /** @use HasFactory<\Database\Factories\HotelFactory> */
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'description',
        'stars',
        'price_per_night',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function origin()
    {
        return $this->belongsTo(Location::class, 'origin');
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