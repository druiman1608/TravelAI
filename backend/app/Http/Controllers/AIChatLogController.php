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
            $aichatlogs = AIChatLog::with('user')->get();
        } else {
            $aichatlogs = AIChatLog::where('user_id', $user->id)->get();
        }

        return view('aichatlogs.index', compact('aichatlogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store() {}

    /**
     * Display the specified resource.
     */
    public function show(AIChatLog $aIChatLog)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (Auth::id() !== $aIChatLog->user_id && !$user->isAdmin()) {
            abort(403);
        }

        return view('aichatlogs.show', compact('aIChatLog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AIChatLog $aIChatLog) {}

    /**
     * Update the specified resource in storage.
     */
    public function update() {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AIChatLog $aIChatLog)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (Auth::id() !== $aIChatLog->user_id && !$user->isAdmin()) {
            abort(403);
        }

        $aIChatLog->delete();
        return redirect()->route('aichatlogs.index');
    }
}