<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AIChatLog;
use Illuminate\Http\Request;
use App\Http\Requests\AIChatLogReq\AIChatLogRequest;

class AIChatLogApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(AIChatLog::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AIChatLogRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        $log = AIChatLog::create($data);

        return response()->json($log, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AIChatLog $aIChatLog)
    {
        return response()->json($aIChatLog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AIChatLogRequest $request, AIChatLog $aIChatLog)
    {
        $aIChatLog->update($request->validated());
        return response()->json($aIChatLog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AIChatLog $aIChatLog)
    {
        $aIChatLog->delete();
        return response()->json(['message' => 'Log con la IA eliminado'], 200);
    }
}
