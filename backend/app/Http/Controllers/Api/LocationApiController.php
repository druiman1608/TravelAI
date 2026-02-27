<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Http\Resources\LocationResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LocationApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(LocationResource::collection(Location::all()));
    }

    public function store(Request $request)
    {
        $item = Location::create($request->all());
        return $this->success(new LocationResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = Location::find($id);
        return $item ? $this->success(new LocationResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = Location::findOrFail($id);
        $item->update($request->all());
        return $this->success(new LocationResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        Location::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}