<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Reservation;
use App\Http\Resources\PassengerResource;
use App\Http\Requests\PassengerReq\PassengerRequest;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class PassengerApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $passengers = Passenger::whereHas('reservation', function ($q) {
            $q->where('user_id', Auth::id());
        })->get();

        return $this->success(PassengerResource::collection($passengers), 'Lista de pasajeros recuperada.');
    }

    public function store(PassengerRequest $request)
    {
        $reservation = Reservation::where('id', $request->reservation_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$reservation) {
            return $this->error('No puedes añadir pasajeros a una reserva que no te pertenece.', 403);
        }

        $passenger = Passenger::create($request->validated());

        return $this->success(new PassengerResource($passenger), 'Pasajero añadido con éxito.', 201);
    }

    public function show(int $id)
    {
        $passenger = Passenger::with('reservation')->find($id);

        if (!$passenger || $passenger->reservation->user_id !== Auth::id()) {
            return $this->error('Pasajero no encontrado o acceso denegado.', 404);
        }

        return $this->success(new PassengerResource($passenger));
    }

    public function update(PassengerRequest $request, int $id)
    {
        $passenger = Passenger::findOrFail($id);

        if ($passenger->reservation->user_id !== Auth::id()) {
            return $this->error('No tienes permiso para editar este pasajero.', 403);
        }

        $passenger->update($request->validated());
        return $this->success(new PassengerResource($passenger), 'Datos del pasajero actualizados.');
    }

    public function destroy(int $id)
    {
        $passenger = Passenger::findOrFail($id);

        if ($passenger->reservation->user_id !== Auth::id()) {
            return $this->error('No tienes permiso para eliminar este pasajero.', 403);
        }

        $passenger->delete();
        return $this->success(null, 'Pasajero eliminado correctamente.');
    }
}