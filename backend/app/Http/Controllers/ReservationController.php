<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationReq\ReservationRequest;

class ReservationController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Reservation::with(['package', 'hotel', 'flight', 'activity', 'user']);

        $reservations = $user->isAdmin()
            ? $query->withTrashed()->latest()->get()
            : $query->where('user_id', $user->id)->latest()->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $packages = Package::all();
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        $activities = Activity::with('location')->get();
        return view('reservations.create', compact('packages', 'hotels', 'flights', 'activities'));
    }

    public function store(ReservationRequest $request)
    {
        $service = new ReservationService();
        $service->store($request->validated());

        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
    }

    public function show($id)
    {
        $reservation = Reservation::withTrashed()->with(['package', 'hotel', 'flight', 'activity', 'user'])->findOrFail($id);

        if (!auth()->user()->isAdmin() && $reservation->user_id !== auth()->id()) {
            abort(403);
        }

        return view('reservations.show', compact('reservation'));
    }

    public function edit($id)
    {
        $reservation = Reservation::withTrashed()->findOrFail($id);

        if (!auth()->user()->isAdmin() && $reservation->user_id !== auth()->id()) {
            abort(403);
        }

        $packages = Package::all();
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        $activities = Activity::all();

        return view('reservations.edit', compact('packages', 'hotels', 'flights', 'activities', 'reservation'));
    }

    public function update(ReservationRequest $request, $id)
    {
        /** @var Reservation $reservation */
        $reservation = Reservation::withTrashed()->findOrFail($id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && $reservation->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        if (!$user->isAdmin()) {
            if ($request->status === 'cancelada') {
                $reservation->update(['status' => 'cancelada']);
                $reservation->delete();
                return redirect()->route('reservations.index')->with('success', 'Reserva cancelada correctamente.');
            }
            return back()->with('error', 'Solo puedes modificar el estado para cancelar la reserva.');
        }

        $service = new ReservationService();
        $service->update($reservation, $request->validated());

        return redirect()->route('reservations.index')->with('success', 'Reserva actualizada y precio recalculado.');
    }

    public function destroy($id)
    {
        /** @var Reservation $reservation */
        $reservation = Reservation::withTrashed()->findOrFail($id);

        if (!auth()->user()->isAdmin() && $reservation->user_id !== auth()->id()) {
            abort(403);
        }

        if (auth()->user()->isAdmin()) {
            $reservation->forceDelete();
        } else {
            $reservation->delete();
        }

        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada.');
    }
}