<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
use Illuminate\Http\Request;

use App\Http\Requests\PackageReq\PackageRequest;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::with('hotel', 'flight', 'activity')->get();

        return view('packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        $activities = Activity::with('location')->get();

        return view('packages.create', compact('hotels', 'flights', 'activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        Package::create($request->validated());
        return redirect()->route('packages.index')->with('success', 'Paquete creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        $activities = Activity::with('location')->get();
        return view('packages.edit', compact('hotels', 'flights', 'activities', 'package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, Package $package)
    {
        $package->update($request->validated());
        return redirect()->route('packages.index')->with('success', 'Paquete actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index');
    }
}