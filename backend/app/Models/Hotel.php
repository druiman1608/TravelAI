<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'description',
        'address',
        'zip_code',
        'stars',
        'services',
        'available_rooms',
        'price_per_night',
        'images',
        'extras'
    ];

    protected $casts = [
        'services' => 'array',
        'images' => 'array',
        'stars' => 'integer',
        'extras' => 'array',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    public function rooms(): HasMany
    {
        return $this->hasMany(HotelRoom::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}