<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserPreference;
use App\Http\Resources\UserPreferenceResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserPreferenceApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(UserPreferenceResource::collection(UserPreference::all()));
    }

    public function store(Request $request)
    {
        $item = UserPreference::create($request->all());
        return $this->success(new UserPreferenceResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = UserPreference::find($id);
        return $item ? $this->success(new UserPreferenceResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = UserPreference::findOrFail($id);
        $item->update($request->all());
        return $this->success(new UserPreferenceResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        UserPreference::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}