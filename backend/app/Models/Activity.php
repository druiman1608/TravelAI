<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'description',
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
}
