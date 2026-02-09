<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Location;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights = Flight::with('location')->get();
        return view('flights.index', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        return view('flights.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'airline' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'departure' => 'required|date|after:now',
            'arrival' => 'required|date|after:departure',
            'price' => 'required|numeric|min:1',
        ]);

        \App\Models\Flight::create($validated);

        return redirect()->route('flights.index')->with('success', 'Vuelo creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        return view('flights.show', compact('flight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        $locations = Location::all();
        return view('flights.edit', compact('locations', 'flight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'airline' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'departure' => 'required|date|after:now',
            'arrival' => 'required|date|after:departure',
            'price' => 'required|numeric|min:1',
        ]);

        $flight->update($validated);
        return redirect()->route('flights.index')->with('success', 'Vuelo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();
        return redirect()->route('flights.index');
    }
}