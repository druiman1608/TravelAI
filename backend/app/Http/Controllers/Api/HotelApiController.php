<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Http\Resources\HotelResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelApiController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with(['location'])->get();
        return HotelResource::collection($hotels);
    }

    public function store(Request $request)
    {
        $v = $request->validate([
            'location_id'     => 'required|exists:locations,id',
            'name'            => 'required|string|max:255',
            'description'     => 'required|string',
            'address'         => 'required|string',
            'zip_code'        => 'required|string',
            'stars'           => 'required|integer|min:1|max:5',
            'available_rooms' => 'required|integer',
            'price_per_night' => 'required|numeric',
            'services'        => 'nullable|array',
            'images'           => 'nullable|array',
            'images.*'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'extras' => 'nullable|string',
        ]);

        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('hotels', 'public');
            }
        }

        $loading = 'ImagesProduccion/Loading/LoadingImage.jpg';
        $v['images'] = $paths ?: [$loading, $loading, $loading];

        if (isset($v['extras']) && is_string($v['extras'])) {
            $v['extras'] = json_decode($v['extras'], true) ?? [];
        }

        $hotel = Hotel::create($v);

        return response()->json([
            'status' => 'success',
            'data'   => new HotelResource($hotel->load('location'))
        ], 201);
    }

    public function show(int $id)
    {
        $hotel = Hotel::with(['rooms', 'reviews', 'location'])->find($id);

        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => new HotelResource($hotel),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $hotel = Hotel::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('images')) {
            if ($hotel->getRawOriginal('images')) {
                $oldImages = is_string($hotel->getRawOriginal('images'))
                    ? json_decode($hotel->getRawOriginal('images'), true)
                    : $hotel->getRawOriginal('images');

                if (is_array($oldImages)) {
                    foreach ($oldImages as $oldPath) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
            }

            $paths = [];
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('hotels', 'public');
            }
            $data['images'] = $paths;
        }

        if (isset($data['extras']) && is_string($data['extras'])) {
            $data['extras'] = json_decode($data['extras'], true) ?? [];
        }

        $hotel->update($data);

        return response()->json([
            'status' => 'success',
            'data'   => new HotelResource($hotel->load('location'))
        ]);
    }

    public function destroy(int $id)
    {
        $hotel = Hotel::findOrFail($id);
        $oldImages = json_decode($hotel->getRawOriginal('images'), true) ?: [];
        foreach ($oldImages as $path) {
            Storage::disk('public')->delete($path);
        }
        $hotel->delete();
        return response()->json(['message' => 'Hotel eliminado']);
    }
}