<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'numero_vuelo'   => $this->flight_number,
            'aerolinea'      => $this->airline,
            'precio'         => (float) $this->price,
            'capacidad'      => $this->capacity,
            'salida'         => $this->departure,
            'llegada'        => $this->arrival,
            'origen_id'      => $this->origin_loc_id,
            'origen_ciudad'  => $this->origin?->city ?? 'N/A',
            'destino_id'     => $this->destination_loc_id,
            'destino_ciudad' => $this->destination?->city ?? 'N/A',
            'duracion'       => $this->duration_time ?? 'N/A',
            'escalas'        => (int) $this->stops,
            'imagen'         => $this->image_url,
            'extras' => $this->extras ?? [],
        ];
    }
}