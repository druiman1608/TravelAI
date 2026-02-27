<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
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
        $price = 0;

        if ($request->filled('package_id')) {
            $price += Package::findOrFail($request->package_id)->total_price;
        }
        if ($request->filled('hotel_id')) {
            $price += Hotel::findOrFail($request->hotel_id)->price_per_night;
        }
        if ($request->filled('flight_id')) {
            $price += Flight::findOrFail($request->flight_id)->price;
        }
        if ($request->filled('activity_id')) {
            $price += Activity::findOrFail($request->activity_id)->price;
        }

        if (Auth::user()->isPremium()) {
            $price = $price * 0.85;
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'package_id' => $request->package_id,
            'hotel_id' => $request->hotel_id,
            'flight_id' => $request->flight_id,
            'activity_id' => $request->activity_id,
            'price' => $price,
            'status' => 'pendiente',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
    }

    public function show(Reservation $reservation)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && $reservation->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta reserva.');
        }

        $reservation->load(['package', 'hotel', 'flight', 'activity', 'user']);
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && $reservation->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta reserva.');
        }

        $packages = Package::all();
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        $activities = Activity::with('location')->get();
        return view('reservations.edit', compact('packages', 'hotels', 'flights', 'activities', 'reservation'));
    }

    public function update(ReservationRequest $request, Reservation $reservation)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && $reservation->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para realizar esta accion.');
        }

        if (!$user->isAdmin()) {
            if ($request->status === 'cancelada') {
                $reservation->update(['status' => 'cancelada']);

                $reservation->delete();

                return redirect()->route('reservations.index')->with('success', 'Reserva cancelada correctamente.');
            }
            return back()->with('error', 'Solo puedes modificar el estado para cancelar la reserva.');
        }

        $data = $request->validated();

        $price = 0;
        if ($request->filled('package_id')) {
            $price += Package::findOrFail($request->package_id)->total_price;
        }
        if ($request->filled('hotel_id')) {
            $price += Hotel::findOrFail($request->hotel_id)->price_per_night;
        }
        if ($request->filled('flight_id')) {
            $price += Flight::findOrFail($request->flight_id)->price;
        }
        if ($request->filled('activity_id')) {
            $price += Activity::findOrFail($request->activity_id)->price;
        }

        if ($reservation->user->isPremium()) {
            $price = $price * 0.85;
        }

        $data['price'] = $price;

        if ($request->status !== 'cancelada' && $reservation->trashed()) {
            $reservation->restore();
        }

        $reservation->update($data);

        return redirect()->route('reservations.index')->with('success', 'Reserva actualizada y precio recalculado.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::withTrashed()->findOrFail($id);

        $reservation->forceDelete();

        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada permanentemente.');
    }
}
