<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'country',
        'continent',
        'weather_type',
        'description',
        'image_url',
        'status'
    ];

    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function flightsOrigin(): HasMany
    {
        return $this->hasMany(Flight::class, 'origin_loc_id');
    }

    public function flightsDestination(): HasMany
    {
        return $this->hasMany(Flight::class, 'destination_loc_id');
    }

    public function getImageUrlAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) return $value;
        return asset('storage/' . $value);
    }
}