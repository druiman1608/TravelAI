<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'usuario' => $this->user->name,
            'total' => $this->price,
            'estado' => $this->status,
            'detalles' => [
                'hotel' => $this->hotel->name ?? null,
                'vuelo' => $this->flight->id ?? null,
                'paquete' => $this->package->name ?? null,
                'actividad' => $this->activity->name ?? null,
            ]
        ];
    }
}