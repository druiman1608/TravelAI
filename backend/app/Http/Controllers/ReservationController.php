<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ReservationReq\ReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Reservation::with(['package', 'hotel', 'flight', 'user']);

        $reservations = $user->isAdmin() ? $query->get() : $query->where('user_id', $user->id)->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all();
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        return view('reservations.create', compact('packages', 'hotels', 'flights'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $price = 0;

        if ($request->filled('package_id')) {
            $package = Package::findOrFail($request->package_id);
            $price = $package->total_price;
        } else if ($request->filled('hotel_id')) {
            $hotel = Hotel::findOrFail($request->hotel_id);
            $price = $hotel->price_per_night;
        } else if ($request->filled('flight_id')) {
            $flight = Flight::findOrFail($request->flight_id);
            $price = $flight->price;
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'package_id' => $request->package_id,
            'hotel_id' => $request->hotel_id,
            'flight_id' => $request->flight_id,
            'price' => $price,
            'status' => 'pendiente',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && $reservation->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta reserva.');
        }

        $reservation->load(['package', 'hotel', 'flight', 'user']);
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $packages = Package::all();
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        return view('reservations.edit', compact('packages', 'hotels', 'flights', 'reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $price = $reservation->price;

        if ($request->filled('package_id')) {
            $price = Package::findOrFail($request->package_id)->total_price;
        } else if ($request->filled('hotel_id')) {
            $price = Hotel::findOrFail($request->hotel_id)->price_per_night;
        } else if ($request->filled('flight_id')) {
            $price = Flight::findOrFail($request->flight_id)->price;
        }

        $reservation->update(array_merge($request->validated(), ['price' => $price]));
        return redirect()->route('reservations.index')->with('success', 'Reserva Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index');
    }
}