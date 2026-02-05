<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hotel_id',
        'flight_id',
        'package_id',
        'rating',
        'comment',
        'state',
        'timestamp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}