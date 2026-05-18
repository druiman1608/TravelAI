<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelRoomResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'hotel_id' => $this->hotel_id,
            'hotel_nombre' => $this->hotel?->name ?? 'N/A',
            'tipo' => $this->type,
            'precio' => (float) $this->price,
            'capacidad' => (int) $this->capacity,
            'stock' => (int) $this->stock,
        ];
    }
}