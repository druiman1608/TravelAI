<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'titular'           => $this->contact_name,
            'dni'               => $this->contact_dni,
            'precio_total'      => (float) $this->total_price,
            'extras_seleccionados' => $this->extras,
            'acompañantes'      => $this->passengers_data,
            'estado'            => $this->mapStatus($this->status),
            'resumen' => [
                'hotel'     => $this->hotel?->name,
                'habitacion' => $this->hotelRoom?->type,
                'vuelo'     => $this->flight?->airline,
                'actividad' => $this->activity?->name,
            ],
            'fecha' => $this->created_at?->format('d-m-Y'),
        ];
    }

    private function mapStatus($status)
    {
        $statuses = [
            'pending'   => 'pendiente',
            'confirmed' => 'confirmada',
            'cancelled' => 'cancelada'
        ];
        return $statuses[$status] ?? $status;
    }
}