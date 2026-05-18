<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Http\Resources\FlightResource;
use App\Http\Requests\FlightReq\FlightRequest;
use Illuminate\Support\Facades\Storage;

class FlightApiController extends Controller
{
    public function index()
    {
        $flights = Flight::with(['origin', 'destination'])->get();
        return FlightResource::collection($flights);
    }

    public function store(FlightRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_flight')) {
            $data['image_url'] = $request->file('image_flight')->store('flights', 'public');
        } else {
            $data['image_url'] = 'ImagesProduccion/Loading/LoadingImage.jpg';
        }

        if (isset($data['extras']) && is_string($data['extras'])) {
            $data['extras'] = json_decode($data['extras'], true) ?? [];
        }

        $flight = Flight::create($data);
        return response()->json([
            'status' => 'success',
            'data'   => new FlightResource($flight->load(['origin', 'destination']))
        ], 201);
    }

    public function update(FlightRequest $request, int $id)
    {
        $flight = Flight::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image_flight')) {
            if ($flight->getRawOriginal('image_url')) {
                Storage::disk('public')->delete($flight->getRawOriginal('image_url'));
            }
            $data['image_url'] = $request->file('image_flight')->store('flights', 'public');
        }

        if (isset($data['extras']) && is_string($data['extras'])) {
            $data['extras'] = json_decode($data['extras'], true) ?? [];
        }

        $flight->update($data);
        return response()->json([
            'status' => 'success',
            'data'   => new FlightResource($flight->load(['origin', 'destination']))
        ]);
    }

    public function destroy(int $id)
    {
        $flight = Flight::findOrFail($id);
        if ($flight->getRawOriginal('image_url')) {
            Storage::disk('public')->delete($flight->getRawOriginal('image_url'));
        }
        $flight->delete();
        return response()->json(['message' => 'Vuelo eliminado']);
    }
}