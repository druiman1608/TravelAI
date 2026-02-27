<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Requests\FlightReq\FlightRequest;

class FlightApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Flight::with('location')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlightRequest $request)
    {
        return response()->json(Flight::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        return response()->json($flight->load('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());
        return response()->json($flight);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();
        return response()->json(['message' => 'Vuelo eliminado'], 200);
    }
}