<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Http\Resources\LocationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationApiController extends Controller
{
    public function index()
    {
        return LocationResource::collection(Location::all());
    }

    public function store(Request $request)
    {
        $v = $request->validate([
            'city'         => 'required|string|max:255',
            'country'      => 'required|string|max:255',
            'continent'    => 'required|string|max:255',
            'weather_type' => 'required|string|max:255',
            'description'  => 'required|string',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:0,1',

        ]);

        if ($request->hasFile('foto')) {
            $v['image_url'] = $request->file('foto')->store('locations', 'public');
        }

        $item = Location::create($v);
        return response()->json([
            'status' => 'success',
            'data'   => new LocationResource($item)
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        $item = Location::findOrFail($id);

        $data = $request->validate([
            'city'         => 'sometimes|string|max:255',
            'country'      => 'sometimes|string|max:255',
            'continent'    => 'sometimes|string|max:255',
            'weather_type' => 'sometimes|string|max:255',
            'description'  => 'sometimes|string',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:0,1',

        ]);

        if ($request->hasFile('foto')) {
            if ($item->getRawOriginal('image_url')) {
                Storage::disk('public')->delete($item->getRawOriginal('image_url'));
            }
            $data['image_url'] = $request->file('foto')->store('locations', 'public');
        }

        $item->update($data);
        return response()->json([
            'status' => 'success',
            'data'   => new LocationResource($item)
        ]);
    }

    public function destroy(int $id)
    {
        $item = Location::findOrFail($id);
        if ($item->image_url) {
            Storage::disk('public')->delete($item->getRawOriginal('image_url'));
        }
        $item->delete();
        return response()->json(['message' => 'Destino eliminado']);
    }
}