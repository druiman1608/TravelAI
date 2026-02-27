<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Http\Resources\ActivityResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ActivityApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(ActivityResource::collection(Activity::all()));
    }

    public function store(Request $request)
    {
        $item = Activity::create($request->all());
        return $this->success(new ActivityResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = Activity::find($id);
        return $item ? $this->success(new ActivityResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = Activity::findOrFail($id);
        $item->update($request->all());
        return $this->success(new ActivityResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        Activity::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}