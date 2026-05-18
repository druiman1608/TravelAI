<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AiChatLogResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'usuario_id'     => $this->user_id,
            'pregunta'       => $this->message,
            'respuesta_ia'   => $this->response,
            'datos_contexto' => $this->context_data,
            'fecha'          => $this->created_at?->format('d-m-Y H:i:s'),
        ];
    }
}