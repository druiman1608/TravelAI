<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReviewResource;

class FlightOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'tipo' => $this->type,
            'precio_total' => (float) $this->total_price,
            'extras' => $this->outboundFlight?->extras ?? [],

            'ida' => [
                'vuelo_id' => $this->outbound_flight_id,
                'origen' => $this->outboundFlight?->origin?->city ?? 'No disponible',
                'destino' => $this->outboundFlight?->destination?->city ?? 'No disponible',
                'salida' => $this->outboundFlight?->departure,
                'llegada' => $this->outboundFlight?->arrival,
                'aerolinea' => $this->outboundFlight?->airline,
                'duracion' => $this->outboundFlight?->duration_time,
                'escalas' => (int) $this->outboundFlight?->stops,
                'imagen_url' => $this->outboundFlight?->image_url,
                'extras' => $this->outboundFlight?->extras ?? [],
            ],

            'vuelta' => $this->when($this->type === 'round_trip' && $this->return_flight_id, [
                'vuelo_id' => $this->return_flight_id,
                'origen' => $this->returnFlight?->origin?->city ?? 'No disponible',
                'destino' => $this->returnFlight?->destination?->city ?? 'No disponible',
                'salida' => $this->returnFlight?->departure,
                'llegada' => $this->returnFlight?->arrival,
                'aerolinea' => $this->returnFlight?->airline,
                'duracion' => $this->returnFlight?->duration_time,
                'escalas' => (int) $this->returnFlight?->stops,
                'imagen_url' => $this->returnFlight?->image_url,
                'extras' => $this->returnFlight?->extras ?? [],
            ]),

            'reviews'   => ReviewResource::collection($this->outboundFlight?->reviews ?? collect()),
            'creado_en' => $this->created_at?->format('d-m-Y H:i:s'),
        ];
    }
}