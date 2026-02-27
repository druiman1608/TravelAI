<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(UserResource::collection(User::all()));
    }

    public function store(Request $request)
    {
        $item = User::create($request->all());
        return $this->success(new UserResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = User::find($id);
        return $item ? $this->success(new UserResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        $item->update($request->all());
        return $this->success(new UserResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}