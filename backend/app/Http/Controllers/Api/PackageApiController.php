<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Http\Resources\PackageResource;
use App\Http\Requests\PackageReq\PackageRequest;
use Illuminate\Support\Facades\Storage;

class PackageApiController extends Controller
{
    public function index()
    {
        $packages = Package::with(['hotel.location', 'flight.destination', 'activity.location'])->get();
        return PackageResource::collection($packages);
    }

    public function store(PackageRequest $request)
    {
        $data = $request->validated();

        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('packages', 'public');
            }
        }

        $data['images'] = $paths;
        $package = Package::create($data);

        return response()->json([
            'status' => 'success',
            'data' => new PackageResource($package->load(['hotel', 'flight', 'activity']))
        ], 201);
    }

    public function show(int $id)
    {
        $package = Package::with(['hotel.location', 'flight.destination', 'activity.location', 'reviews.user'])
            ->findOrFail($id);
        return new PackageResource($package);
    }

    public function update(PackageRequest $request, int $id)
    {
        $package = Package::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('packages', 'public');
            }
            $data['images'] = $paths;
        }

        $package->update($data);

        return response()->json([
            'status' => 'success',
            'data' => new PackageResource($package->load(['hotel', 'flight', 'activity']))
        ]);
    }

    public function destroy(int $id)
    {
        $package = Package::findOrFail($id);
        $images = $package->images ?? [];

        foreach ($images as $path) {
            Storage::disk('public')->delete($path);
        }

        $package->delete();
        return response()->json(['message' => 'Paquete eliminado correctamente']);
    }
}