<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\ReviewReq\ReviewRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewApiController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Review::with('user')->where('status', 'approved');

        foreach (['hotel_id', 'activity_id', 'flight_id', 'package_id'] as $field) {
            if ($request->has($field)) {
                $query->where($field, $request->get($field));
            }
        }

        return $this->success(ReviewResource::collection($query->latest()->get()));
    }

    public function store(ReviewRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $review = Review::create($validated);

        return $this->success(new ReviewResource($review), 'Reseña enviada. Será revisada por moderación.', 201);
    }

    public function show(int $id)
    {
        $item = Review::with(['user'])->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $item
        ]);
    }

    public function pendingReviews()
    {
        $reviews = Review::with('user')->where('status', 'pending')->latest()->get();
        return $this->success(ReviewResource::collection($reviews), 'Reseñas pendientes.');
    }

    public function userReviews()
    {
        $reviews = Review::where('user_id', Auth::id())
            ->with(['hotel', 'activity', 'flight', 'package'])
            ->latest()
            ->get();

        return $this->success(ReviewResource::collection($reviews), 'Tus reseñas recuperadas.');
    }

    public function updateStatus(Request $request, int $id)
    {
        $review = Review::findOrFail($id);
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $review->update(['status' => $request->status]);
        return $this->success(new ReviewResource($review), 'Estado actualizado.');
    }

    public function update(ReviewRequest $request, Review $review)
    {
        if (Auth::id() !== $review->user_id && !Auth::user()->isAdmin()) {
            return $this->error('No tienes permiso para editar esta reseña', 403);
        }

        $review->update($request->validated());

        return $this->success(new ReviewResource($review), 'Reseña actualizada.');
    }

    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id && !Auth::user()->isAdmin()) {
            return $this->error('No puedes eliminar esta reseña', 403);
        }

        $review->delete();
        return $this->success(null, 'Reseña eliminada correctamente.');
    }
}