<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'continent' => 'required|string|max:255',
            'weather_type' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url|max:255',
            'status' => 'boolean',
        ]);

        \App\Models\Location::created($validated);

        return redirect()->route('locations.index')->with('success', 'Localizacion creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'continent' => 'required|string|max:255',
            'weather_type' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url|max:255',
            'status' => 'boolean',

        ]);

        $location->update($validated);
        return redirect()->route('locations.index')->with('success', 'Localizacion actualizad');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index');
    }
}