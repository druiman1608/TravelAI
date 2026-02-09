<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'hotel_id' => 'required|exists:hotels,id',
            'flight_id' => 'required|exists:flights,id',
        ]);

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
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        // NECESITO VALIDAR SI EL QUE ESTA EDITANDO LA RESERVA ES ADMIN O EL PROPIOP USER

        $reservation->update($validated);
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