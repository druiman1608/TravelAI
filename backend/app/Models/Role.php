<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    const ADMIN = 'Administrador';
    const MODERATOR = 'Moderador';
    const PREMIUM = 'Premium';
    const USER = 'Usuario';

    protected $fillable = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}