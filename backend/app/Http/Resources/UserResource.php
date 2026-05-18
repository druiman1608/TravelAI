<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'nombre'     => $this->name,
            'email'      => $this->email,
            'telefono'   => $this->phone_number,
            'foto'       => $this->profile_photo_path
                ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->profile_photo_path)
                : null,
            'estado'     => $this->status,
            'rol_id'     => (int)$this->role_id,
            'rol_nombre' => $this->role?->name ?? 'Usuario',
            'preferencias' => $this->preferences ? new UserPreferenceResource($this->preferences) : null,
            'total_reservas' => $this->reservations_count ?? 0,
            'total_resenas'  => $this->reviews_count ?? 0,
        ];
    }
}