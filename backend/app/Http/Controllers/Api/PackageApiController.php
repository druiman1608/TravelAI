<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Http\Resources\PackageResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PackageApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(PackageResource::collection(Package::all()));
    }

    public function store(Request $request)
    {
        $item = Package::create($request->all());
        return $this->success(new PackageResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = Package::find($id);
        return $item ? $this->success(new PackageResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = Package::findOrFail($id);
        $item->update($request->all());
        return $this->success(new PackageResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        Package::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}