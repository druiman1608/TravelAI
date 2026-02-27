<?php

namespace App\Http\Controllers;

use App\Models\AIChatLog;
use App\Services\AIChatService;
use Illuminate\Http\Request;
use App\Http\Requests\AIChatLogReq\AIChatLogRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AIChatLogController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                $user = auth()->user();
                if (!$user || (!$user->isAdmin() && !$user->isPremium())) {
                    return redirect()->route('dashboard')->with('error', 'El chat con IA es exclusivo para usuarios Premium.');
                }
                return $next($request);
            }),
        ];
    }

    public function index()
    {
        $user = auth()->user();
        $logs = $user->isAdmin()
            ? AIChatLog::with('user')->latest()->get()
            : AIChatLog::where('user_id', $user->id)->latest()->get();

        return view('aichatlogs.index', compact('logs'));
    }

    public function create()
    {
        return view('aichatlogs.create');
    }

    public function store(AIChatLogRequest $request)
    {
        $service = new AIChatService();
        $service->chat($request->validated()['user_question']);

        return redirect()->route('aichatlogs.index')->with('success', 'La IA ha respondido.');
    }

    public function show(AIChatLog $aichatlog)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->isAdmin() && $aichatlog->user_id !== $user->id) {
            abort(403);
        }

        $aichatlog->load('user');

        return view('aichatlogs.show', ['aiChatLog' => $aichatlog]);
    }

    public function destroy($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Solo los administradores pueden borrar el historial.');
        }

        $log = AIChatLog::findOrFail($id);
        $log->delete();

        return redirect()->route('aichatlogs.index')->with('success', 'Log eliminado correctamente.');
    }
}