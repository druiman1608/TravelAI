<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Http\Resources\ActivityResource;
use App\Http\Requests\ActivityReq\ActivityRequest;
use Illuminate\Support\Facades\Storage;

class ActivityApiController extends Controller
{
    public function index()
    {
        $activities = Activity::with(['location'])->get();
        return ActivityResource::collection($activities);
    }

    public function store(ActivityRequest $request)
    {
        $data = $request->validated();

        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('activities', 'public');
            }
        }

        if (isset($data['extras']) && is_string($data['extras'])) {
            $data['extras'] = json_decode($data['extras'], true) ?? [];
        }

        $loading = 'ImagesProduccion/Loading/LoadingImage.jpg';
        $data['images'] = $paths ?: [$loading, $loading, $loading];
        $activity = Activity::create($data);

        return response()->json([
            'status' => 'success',
            'data'   => new ActivityResource($activity->load('location'))
        ], 201);
    }

    public function show(int $id)
    {
        $activity = Activity::with(['reviews' => fn($q) => $q->where('status', 'approved')->with('user'), 'location'])->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => new ActivityResource($activity),
        ]);
    }

    public function update(ActivityRequest $request, int $id)
    {
        $activity = Activity::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('activities', 'public');
            }
            $data['images'] = $paths;
        }

        if (isset($data['extras']) && is_string($data['extras'])) {
            $data['extras'] = json_decode($data['extras'], true) ?? [];
        }

        $activity->update($data);
        return response()->json([
            'status' => 'success',
            'data'   => new ActivityResource($activity->load('location'))
        ]);
    }

    public function destroy(int $id)
    {
        $activity = Activity::findOrFail($id);
        $images = $activity->images ?? [];

        foreach ($images as $path) {
            Storage::disk('public')->delete($path);
        }

        $activity->delete();
        return response()->json(['message' => 'Actividad eliminada']);
    }
}