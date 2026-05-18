<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'usuario_id'     => $this->user_id,
            'usuario_nombre' => $this->user?->name ?? 'Usuario Anónimo',
            'puntuacion'     => (int) $this->rating,
            'comentario'     => $this->comment,
            'estado'         => $this->mapStatus($this->status),
            'fecha'          => $this->created_at?->format('d/m/Y'),
            'referencia' => [
                'hotel_id'    => $this->hotel_id,
                'vuelo_id'    => $this->flight_id,
                'paquete_id'  => $this->package_id,
                'actividad_id' => $this->activity_id,
            ]
        ];
    }

    private function mapStatus($status)
    {
        return [
            'pending'  => 'pendiente',
            'approved' => 'aprobada',
            'rejected' => 'rechazada',
        ][$status] ?? $status;
    }
}