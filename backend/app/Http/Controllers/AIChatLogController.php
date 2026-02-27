<?php

namespace App\Http\Controllers;

use App\Models\AIChatLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AIChatLogReq\AIChatLogRequest;

class AIChatLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $logs = \App\Models\AIChatLog::with('user')->get();
        } else {
            $logs = \App\Models\AIChatLog::with('user')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('aichatlogs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aichatlogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AIChatLogRequest $request)
    {

        $responses = [
            "Claro, el mejor hotel en esa zona es el Hotel del Sol.",
            "Tu vuelo está programado para salir a tiempo.",
            "Recuerda que como usuario Premium tienes descuentos exclusivos.",
            "Puedo ayudarte a planificar tu próxima actividad en la ciudad."
        ];

        AIChatLog::create([
            'user_id' => Auth::id(),
            'user_question' => $request->validated()['user_question'],
            'ai_answer' => $responses[array_rand($responses)],
        ]);

        return redirect()->route('aichatlogs.index')->with('success', 'La IA ha respondido.');
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AIChatLog $aIChatLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AIChatLog $aIChatLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AIChatLog $aichatlog)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $aichatlog->delete();
        return redirect()->route('aichatlogs.index')->with('success', 'Log eliminado correctamente.');
    }
}
