<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Http\Resources\ReviewResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReviewApiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(ReviewResource::collection(Review::all()));
    }

    public function store(Request $request)
    {
        $item = Review::create($request->all());
        return $this->success(new ReviewResource($item), 'Creado', 201);
    }

    public function show($id)
    {
        $item = Review::find($id);
        return $item ? $this->success(new ReviewResource($item)) : $this->error('No encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $item = Review::findOrFail($id);
        $item->update($request->all());
        return $this->success(new ReviewResource($item), 'Actualizado');
    }

    public function destroy($id)
    {
        Review::destroy($id);
        return $this->success(null, 'Eliminado');
    }
}