<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Http\Resources\ReservationResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReservationApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(ReservationResource::collection(Reservation::all()));
    }

    public function store(Request $request)
    {
        $item = Reservation::create($request->all());
        return $this->success(new ReservationResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = Reservation::find($id);
        return $item ? $this->success(new ReservationResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = Reservation::findOrFail($id);
        $item->update($request->all());
        return $this->success(new ReservationResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        Reservation::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}