<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Http\Resources\ReservationResource;
use App\Http\Requests\ReservationReq\ReservationRequest;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class ReservationApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $reservations = Reservation::with(['package', 'hotel', 'flight', 'activity'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return $this->success(ReservationResource::collection($reservations), 'Mis reservas recuperadas.');
    }

    public function store(ReservationRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status'] = 'confirmed';

        $reservation = Reservation::create($data);

        if ($request->has('passengers')) {
            foreach ($request->passengers as $pax) {
                $reservation->passengers()->create([
                    'first_name'      => $pax['first_name'] ?? $pax['nombre'],
                    'last_name'       => $pax['last_name'] ?? '',
                    'document_number' => $pax['document_number'] ?? $pax['dni'],
                    'type'            => $pax['type'] ?? 'adult',
                ]);
            }
        }

        return $this->success(new ReservationResource($reservation), 'Reserva completada con éxito', 201);
    }

    public function show(int $id)
    {
        $item = Reservation::with(['user', 'package', 'hotel', 'flight', 'activity', 'passengers'])
            ->find($id);

        if (!$item) return $this->error('Reserva no encontrada', 404);

        if ($item->user_id !== Auth::id()) {
            return $this->error('No tienes permiso para ver esta reserva', 403);
        }

        return $this->success(new ReservationResource($item));
    }

    public function update(ReservationRequest $request, int $id)
    {
        $item = Reservation::findOrFail($id);

        if ($item->user_id !== Auth::id()) {
            return $this->error('Acceso denegado', 403);
        }

        $item->update($request->validated());
        return $this->success(new ReservationResource($item), 'Reserva actualizada');
    }

    public function destroy(int $id)
    {
        $item = Reservation::find($id);
        if (!$item) return $this->error('No existe', 404);

        if ($item->user_id !== Auth::id()) {
            return $this->error('No tienes permiso para eliminar esta reserva', 403);
        }

        $item->delete();
        return $this->success(null, 'Reserva eliminada');
    }
}
