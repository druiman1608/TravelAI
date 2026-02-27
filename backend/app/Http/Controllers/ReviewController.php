<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReviewReq\ReviewRequest;

class ReviewController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $query = Review::with(['user', 'hotel', 'flight', 'package', 'activity']);

        if ($user->isAdmin() || $user->isMod()) {
            $reviews = $query->latest()->get();
        } else {
            $reviews = $query->where('user_id', $user->id)
                ->where('status', '!=', 'cancelada')
                ->latest()
                ->get();
        }

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
        Review::create(array_merge($request->validated(), [
            'user_id' => Auth::id(),
            'status' => 'pendiente'
        ]));
        return redirect()->route('reviews.index')->with('success', 'Reseña enviada a moderación.');
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

    public function update(ReviewRequest $request, Review $review)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isMod() && $review->user_id !== $user->id) {
            abort(403);
        }

        if (!$user->isAdmin() && !$user->isMod()) {
            if ($request->status === 'cancelada') {
                $review->status = 'cancelada';
                $review->save();
                return redirect()->route('reviews.index')->with('success', 'Reseña cancelada.');
            }

            $review->comment = $request->comment;
            $review->rating = $request->rating;
            $review->status = 'pendiente';
            $review->save();
            return redirect()->route('reviews.index')->with('success', 'Reseña actualizada y enviada a moderación.');
        }

        if ($user->isAdmin() || $user->isMod()) {
            $review->status = $request->status;

            if ($user->isAdmin()) {
                $review->comment = $request->comment;
                $review->rating = $request->rating;
            }
        }

        $review->save();

        return redirect()->route('reviews.index')->with('success', 'Reseña moderada correctamente.');
    }

    public function destroy(Review $review)
    {
        if (!Auth::user()->isAdmin() && $review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Reseña eliminada físicamente.');
    }
}
