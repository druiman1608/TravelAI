<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Http\Resources\HotelResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class HotelApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(HotelResource::collection(Hotel::all()));
    }

    public function store(Request $request)
    {
        $item = Hotel::create($request->all());
        return $this->success(new HotelResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = Hotel::find($id);
        return $item ? $this->success(new HotelResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = Hotel::findOrFail($id);
        $item->update($request->all());
        return $this->success(new HotelResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        Hotel::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}