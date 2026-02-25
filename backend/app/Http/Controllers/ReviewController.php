<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ReviewReq\ReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Review::with(['user', 'hotel', 'flight', 'package']);

        $reviews = ($user->isAdmin() || $user->isMod())
            ? $query->latest()->get()
            : $query->where('user_id', $user->id)->latest()->get();

        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all();
        $hotels = Hotel::with('location')->get();
        $flights = Flight::with('location')->get();
        return view('reviews.create', compact('packages', 'hotels', 'flights'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        Review::create(array_merge($request->validated(), [
            'user_id' => Auth::id(),
            'status' => 'pendiente'
        ]));
        return redirect()->route('reviews.index')->with('success', 'Reseña creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isMod() && $review->user_id !== $user->id) {
            abort(403);
        }

        $review->load(['user', 'hotel', 'flight', 'package']);
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
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

        return view('reviews.edit', compact('packages', 'hotels', 'flights', 'review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $review->update($request->validated());
        return redirect()->route('reviews.index')->with('success', 'Reseña actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->isAdmin() && $review->user_id !== $user->id) {
            abort(403);
        }

        $review->delete();
        return redirect()->route('reviews.index');
    }
}