<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AIChatLog;
use App\Models\Role;
use App\Http\Resources\AiChatLogResource;
use App\Http\Requests\AIChatLogReq\AIChatLogRequest;
use App\Services\AIChatService;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AIChatLogApiController extends Controller
{
    use ApiResponse;

    const FREE_LIMIT = 10;

    public function index()
    {
        $logs = AIChatLog::where('user_id', Auth::id())
            ->latest()
            ->get();

        return $this->success(
            AiChatLogResource::collection($logs),
            'Historial de chat recuperado.'
        );
    }

    public function store(AIChatLogRequest $request, AIChatService $service)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->loadMissing('role');
        $isPremium = $user->role?->name === Role::PREMIUM;

        if (!$isPremium) {
            $count = AIChatLog::where('user_id', Auth::id())->count();
            if ($count >= self::FREE_LIMIT) {
                return $this->error(
                    'Has alcanzado el límite de ' . self::FREE_LIMIT . ' mensajes gratuitos. Hazte Premium para disfrutar de mensajes ilimitados con la IA.',
                    403
                );
            }
        }

        $history = AIChatLog::where('user_id', Auth::id())
            ->latest()
            ->take(6)
            ->get()
            ->reverse()
            ->map(fn($log) => [
                'pregunta'     => $log->message,
                'respuesta_ia' => $log->response,
            ])
            ->values()
            ->toArray();

        $log = $service->chat($request->validated()['message'], $history, $isPremium);

        return $this->success(
            new AiChatLogResource($log),
            'Interacción guardada correctamente.',
            201
        );
    }

    public function show(int $id)
    {
        $log = AIChatLog::where('user_id', Auth::id())->find($id);

        if (!$log) {
            return $this->error('Log de chat no encontrado o no pertenece a tu usuario.', 404);
        }

        return $this->success(new AiChatLogResource($log));
    }
}
