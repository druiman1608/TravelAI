<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use App\Http\Requests\UserPreferenceReq\UserPreferenceRequest;

class UserPreferenceApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(UserPreference::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPreferenceRequest $request)
    {
        return response()->json(UserPreference::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPreference $userPreference)
    {
        return response()->json($userPreference);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPreferenceRequest $request, UserPreference $userPreference)
    {
        $userPreference->update($request->validated());
        return response()->json($userPreference);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPreference $userPreference)
    {
        $userPreference->delete();
        return response()->json(['message' => 'Preferencia eliminada'], 200);
    }
}