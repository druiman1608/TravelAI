<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PassengerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'reserva_id' => $this->reservation_id,
            'tipo'       => $this->type,
            'nombre'     => $this->first_name,
            'apellidos'  => $this->last_name,
            'documento'  => $this->document_number ?? 'No aportado',
            'nombre_completo' => "{$this->first_name} {$this->last_name}",
        ];
    }
}