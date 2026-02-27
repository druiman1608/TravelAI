<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Requests\PackageReq\PackageRequest;


class PackageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Package::with(['hotel', 'flight', 'activities'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        return response()->json(Package::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return response()->json($package->load(['hotel', 'flight', 'activities']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, Package $package)
    {
        $package->update($request->validated());
        return response()->json($package);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return response()->json(['message' => 'Paquete eliminado'], 200);
    }
}