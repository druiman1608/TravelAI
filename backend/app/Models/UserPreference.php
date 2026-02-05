<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    /** @use HasFactory<\Database\Factories\UserPreferenceFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'travel_type',
        'max_budget',
        'fav_weather'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}