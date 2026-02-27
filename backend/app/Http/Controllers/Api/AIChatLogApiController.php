<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AIChatLog;
use App\Http\Resources\AiChatLogResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AIChatLogApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(AiChatLogResource::collection(AIChatLog::all()));
    }

    public function store(Request $request)
    {
        $item = AIChatLog::create($request->all());
        return $this->success(new AiChatLogResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = AIChatLog::find($id);
        return $item ? $this->success(new AiChatLogResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = AIChatLog::findOrFail($id);
        $item->update($request->all());
        return $this->success(new AiChatLogResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        AIChatLog::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}