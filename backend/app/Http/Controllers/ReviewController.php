<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReviewReq\ReviewRequest;

class ReviewController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $query = Review::with(['user', 'hotel', 'flight', 'package']);

        if (!$user->isAdmin() && !$user->isMod()) {
            $query->where(function ($q) use ($user) {
                $q->where('status', 'publicada')
                    ->orWhere(function ($sub) use ($user) {
                        $sub->where('user_id', $user->id)
                            ->where('status', 'pendiente');
                    });
            });

            $query->where('status', '!=', 'borrada');
        }

        $reviews = $query->latest()->get();

        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        $packages = Package::all();
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        $activities = Activity::all();

        return view('reviews.create', compact('packages', 'hotels', 'flights', 'activities'));
    }

    public function store(ReviewRequest $request)
    {
        $service = new ReviewService();
        $service->store($request->validated());

        return redirect()->route('reviews.index')->with('success', 'Reseña enviada a moderacion.');
    }

    public function show($id)
    {
        $review = Review::with(['user', 'hotel', 'flight', 'package', 'activity'])->findOrFail($id);
        return view('reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isMod() && $review->user_id !== $user->id) {
            abort(403);
        }

        $packages = Package::all();
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        $activities = Activity::all();

        return view('reviews.edit', compact('packages', 'hotels', 'flights', 'activities', 'review'));
    }

    public function update(Request $request, $id)
    {
        /** @var Review $review */
        $review = Review::findOrFail($id);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $data = $request->validate([
            'status' => 'required|in:pendiente,publicada,borrada',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ]);

        $service = new ReviewService();
        $service->handleUpdate($review, $data, $user);

        return redirect()->route('reviews.index')->with('success', 'Cambios guardados correctamente.');
    }

    public function destroy(Review $review)
    {
        if (!Auth::user()->isAdmin() && $review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Reseña eliminada.');
    }
}