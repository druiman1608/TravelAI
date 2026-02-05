<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    protected $fillable = [
        'city',
        'country',
        'continent',
        'weather_type',
        'description',
        'image',
        'status',
        'timestamp',
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}