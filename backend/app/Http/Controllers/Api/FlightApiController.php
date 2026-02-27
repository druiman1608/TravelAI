<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Http\Resources\FlightResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FlightApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(FlightResource::collection(Flight::all()));
    }

    public function store(Request $request)
    {
        $item = Flight::create($request->all());
        return $this->success(new FlightResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = Flight::find($id);
        return $item ? $this->success(new FlightResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = Flight::findOrFail($id);
        $item->update($request->all());
        return $this->success(new FlightResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        Flight::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}