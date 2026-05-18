<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'ciudad'      => $this->city,
            'pais'        => $this->country,
            'continente'  => $this->continent,
            'clima'       => $this->weather_type,
            'descripcion' => $this->description,
            'imagen'      => $this->image_url,
            'activo'      => (bool)$this->status,
        ];
    }
}