<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'timestamp'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function aiChatLogs()
    {
        return $this->hasMany(AIChatLog::class);
    }
}