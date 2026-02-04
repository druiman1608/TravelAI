<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $fillable = [
        'nombre',
        'ciudad',
        'direccion',
        'estrellas',
        'precio_noche',
        'destination_id',
        'descripcion',
        'imagen_url'
    ];

    public function getImagenUrlAtribute($value)
    {
        return $value ?? 'https://via.placeholder.com/300x200?text=Sin+Foto';
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}