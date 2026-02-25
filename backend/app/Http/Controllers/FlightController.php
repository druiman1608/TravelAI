<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activity\FlightRequest as ActivityFlightRequest;
use App\Models\Flight;
use App\Models\Location;
use Illuminate\Http\Request;

use App\Http\Requests\FlightReq\FlightRequest;

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
    public function store(FlightRequest $request)
    {
        Flight::create($request->validated());
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
    public function update(FlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());
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