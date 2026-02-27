<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Resources\RoleResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoleApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(RoleResource::collection(Role::all()));
    }

    public function store(Request $request)
    {
        $item = Role::create($request->all());
        return $this->success(new RoleResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = Role::find($id);
        return $item ? $this->success(new RoleResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = Role::findOrFail($id);
        $item->update($request->all());
        return $this->success(new RoleResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}