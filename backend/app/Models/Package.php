<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'flight_id',
        'activity_id',
        'name',
        'description',
        'itinerary',
        'total_price',
        'discount_price',
        'images'
    ];

    protected $casts = [
        'itinerary' => 'array',
        'total_price' => 'float',
        'discount_price' => 'float',
        'images' => 'array'
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}