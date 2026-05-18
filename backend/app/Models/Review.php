<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hotel_id',
        'activity_id',
        'flight_id',
        'package_id',
        'rating',
        'comment',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}