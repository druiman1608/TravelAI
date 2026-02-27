<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Package;
use App\Models\Activity;
use App\Models\User;
use App\Models\Reservation;
use App\Models\AIChatLog;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $latestReviews = Review::with('user')
            ->where('status', 'publicada')
            ->latest()
            ->take(3)
            ->get();

        $data = [
            'hotels' => Hotel::with('location')->latest()->take(5)->get(),
            'flights' => Flight::with('location')->latest()->take(5)->get(),
            'packages' => Package::latest()->take(5)->get(),
            'activities' => Activity::with('location')->latest()->take(5)->get(),
            'latest_reviews' => $latestReviews,
        ];

        if ($user->isAdmin()) {
            $data['users'] = User::latest()->take(5)->get();
        }

        $data['reservations'] = Reservation::where('user_id', $user->id)->latest()->take(5)->get();
        $data['aichatlogs'] = AIChatLog::where('user_id', $user->id)->latest()->take(5)->get();

        return view('dashboard.index', compact('data'));
    }
}