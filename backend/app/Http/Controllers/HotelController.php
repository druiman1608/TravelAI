<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hoteles y su destination
        $hoteles = Hotel::with('destination')->get();
        return response()->json($hoteles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear hotel
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estrellas' => 'required|integer|min:1|max:5',
            'destination_id' => 'required|exists:destinations,id',
            'descripcion' => 'nullable|string',
            'imagen_url' => 'nullable|url'
        ]);

        $hotel = Hotel::create($validatedData);
        return response()->json($hotel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ver un hotel
        $hotel = Hotel::with('destination')->find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 404);
        }
        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Actualizar hotel
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'ciudad' => 'sometimes|required|string|max:255',
            'direccion' => 'sometimes|required|string|max:255',
            'estrellas' => 'sometimes|required|integer|min:1|max:5',
            'destination_id' => 'sometimes|required|exists:destinations,id',
            'descripcion' => 'nullable|string',
            'imagen_url' => 'nullable|url'
        ]);

        $hotel->update($validatedData);
        return response()->json(['message' => 'Hotel actualizado']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar hotel
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 404);
        }

        $hotel->delete();
        return response()->json(['message' => 'Hotel eliminado']);
    }
}