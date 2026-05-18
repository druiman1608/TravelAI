<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PackageResource extends JsonResource
{
    public function toArray($request): array
    {
        $destino = $this->hotel?->location?->city ?? $this->flight?->destination?->city ?? 'Destino Global';

        return [
            'id'            => $this->id,
            'nombre'        => $this->name,
            'descripcion'   => $this->description,
            'itinerario'    => $this->itinerary ?? [],
            'precio_total'  => $this->total_price,
            'precio_oferta' => $this->discount_price,
            'ahorro'        => $this->discount_price ? round($this->total_price - $this->discount_price, 2) : 0,
            'imagenes'      => collect($this->images ?? [])->map(fn($img) => Storage::disk('public')->url($img))->values(),
            'destino'       => $destino,
            'vuelo'         => new FlightResource($this->whenLoaded('flight')),
            'hotel'         => new HotelResource($this->whenLoaded('hotel')),
            'actividad'     => new ActivityResource($this->whenLoaded('activity')),
            'reviews'       => ReviewResource::collection($this->whenLoaded('reviews')),
        ];
    }
}
