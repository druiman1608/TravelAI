<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'description',
        'duration',
        'price',
        'included_features',
        'type',
        'images',
        'extras'
    ];

    protected $casts = [
        'included_features' => 'array',
        'price' => 'float',
        'extras' => 'array',
        'images' => 'array',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}