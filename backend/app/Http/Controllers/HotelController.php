<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Location;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::with('location')->get();
        return view('hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $locations = Location::all();
        return view('hotels.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
            'price_per_night' => 'required|numeric|min:1',
        ]);

        \App\Models\Hotel::create($validated);

        return redirect()->route('hotels.index')->with('success', 'Hotel creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        $locations = Location::all();
        return view('hotels.edit', compact('locations', 'hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
            'location_id' => 'required|exists:locations,id',
            'price_per_night' => 'required|numeric|min:1',
        ]);

        $hotel->update($validated);
        return redirect()->route('hotels.index')->with('success', 'Hotel actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index');
    }
}