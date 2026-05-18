<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ActivityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                  => $this->id,
            'nombre'              => $this->name,
            'descripcion'         => $this->description,
            'duracion'            => $this->duration,
            'precio'              => (float) $this->price,
            'tipo'                => $this->type ?? 'Tour',
            'servicios_incluidos' => $this->included_features ?? [],
            'ubicacion_id'        => $this->location_id,
            'ubicacion_nombre'    => $this->location?->city ?? 'N/A',
            'imagenes'            => collect($this->images ?? [])->map(fn($img) => Storage::disk('public')->url($img))->values(),
            'reviews'             => ReviewResource::collection($this->whenLoaded('reviews')),
            'extras'              => $this->extras,
        ];
    }
}
