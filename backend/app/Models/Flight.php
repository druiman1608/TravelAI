<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_number',
        'origin_loc_id',
        'destination_loc_id',
        'airline',
        'departure',
        'arrival',
        'capacity',
        'price',
        'duration_time',
        'stops',
        'image_url',
        'extras'
    ];

    protected $casts = [
        'extras' => 'array'
    ];

    public function getImageUrlAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) return $value;
        return asset('storage/' . $value);
    }

    public function origin(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'origin_loc_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'destination_loc_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}