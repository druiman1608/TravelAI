<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ReviewResource;

class HotelResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'nombre'            => $this->name,
            'descripcion'       => $this->description,
            'direccion'         => $this->address,
            'codigo_postal'     => $this->zip_code,
            'estrellas'         => $this->stars,
            'servicios'         => $this->services ?? [],
            'habitaciones_disp' => $this->available_rooms,
            'precio_noche'      => (float) $this->price_per_night,
            'ubicacion_id'      => $this->location_id,
            'ubicacion_nombre'  => $this->location?->city ?? 'N/A',
            'imagenes'          => collect($this->images ?? [])->map(fn($img) => Storage::disk('public')->url($img))->values(),
            'habitaciones'      => HotelRoomResource::collection($this->whenLoaded('rooms')),
            'reviews'           => ReviewResource::collection($this->whenLoaded('reviews')),
            'extras'            => $this->extras,
        ];
    }
}
