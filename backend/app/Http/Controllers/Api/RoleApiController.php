<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Resources\RoleResource;

class RoleApiController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return RoleResource::collection($roles);
    }

    public function show(int $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }
        return new RoleResource($role);
    }
}