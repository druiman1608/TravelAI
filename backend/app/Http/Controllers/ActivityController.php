<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Location;
use Illuminate\Http\Request;

use App\Http\Requests\Activity\ActivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with('location')->get();
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        return view('activities.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        Activity::create($request->validated());
        return redirect()->route('activities.index')->with('success', 'Actividad creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $locations = Location::all();
        return view('activities.edit', compact('locations', 'activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityRequest $request, Activity $activity)
    {
        $activity->update($request->validated());
        return redirect()->route('activities.index')->with('success', 'Actividad actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index');
    }
}