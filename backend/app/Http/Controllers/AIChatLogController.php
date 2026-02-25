<?php

namespace App\Http\Controllers;

use App\Models\AIChatLog;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\AIChatLog\AIChatLogRequest;

class AIChatLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isAdmin()) {
            $logs = AIChatLog::with('user')->latest()->get();
        } else {
            $logs = AIChatLog::where('user_id', $user->id)->latest()->get();
        }

        return view('aichatlogs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(AIChatLog $aichatlog)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($aichatlog->user_id !== $user->id && !$user->isAdmin()) {
            abort(403, 'No tienes permiso para acceder a este chat');
        }

        return view('aichatlogs.show', compact('aichatlog'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AIChatLog $aichatlog)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($aichatlog->user_id !== $user->id && !$user->isAdmin()) {
            abort(403, 'No tienes permiso para borrar a este chat');
        }

        $aichatlog->delete();
        return redirect()->route('aichatlogs.index');
    }
}