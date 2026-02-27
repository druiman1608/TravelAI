<?php

namespace App\Services;

use App\Models\AIChatLog;
use Illuminate\Support\Facades\Auth;

class AIChatService
{
    protected $responses = [
        "Claro, el mejor hotel en esa zona es el Hotel del Sol.",
        "Tu vuelo está programado para salir a tiempo.",
        "Como usuario Premium tienes descuentos exclusivos.",
        "Puedo ayudarte a planificar tu próxima actividad."
    ];

    public function chat($question)
    {
        return AIChatLog::create([
            'user_id' => Auth::id(),
            'user_question' => $question,
            'ai_answer' => $this->responses[array_rand($this->responses)],
        ]);
    }
}