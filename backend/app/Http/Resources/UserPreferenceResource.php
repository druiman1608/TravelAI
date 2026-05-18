<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPreferenceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'              => $this->id,
            'user_id'         => $this->user_id,
            'tipo_viaje'      => $this->travel_type,
            'presupuesto_max' => (float)$this->max_budget,
            'clima_favorito'  => $this->fav_weather,
        ];
    }
}