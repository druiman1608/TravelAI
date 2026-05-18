<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HotelRoom;
use App\Http\Resources\HotelRoomResource;
use App\Http\Requests\HotelRoomReq\HotelRoomRequest;
use App\Traits\ApiResponse;

class HotelRoomApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $rooms = HotelRoom::with('hotel')->get();
        return $this->success(HotelRoomResource::collection($rooms), 'Habitaciones recuperadas.');
    }

    public function store(HotelRoomRequest $request)
    {
        $item = HotelRoom::create($request->validated());
        return $this->success(new HotelRoomResource($item), 'Habitación creada con éxito', 201);
    }

    public function show(int $id)
    {
        $item = HotelRoom::with('hotel')->find($id);

        if (!$item) {
            return $this->error("La habitación con ID {$id} no existe.", 404);
        }

        return $this->success(new HotelRoomResource($item));
    }

    public function update(HotelRoomRequest $request, int $id)
    {
        $item = HotelRoom::find($id);

        if (!$item) {
            return $this->error("No se puede actualizar: Habitación no encontrada.", 404);
        }

        $item->update($request->validated());
        return $this->success(new HotelRoomResource($item), 'Habitación actualizada correctamente');
    }

    public function destroy(int $id)
    {
        $item = HotelRoom::find($id);

        if (!$item) {
            return $this->error("No se puede eliminar: Habitación no encontrada.", 404);
        }

        $item->delete();
        return $this->success(null, 'Habitación eliminada correctamente');
    }
}