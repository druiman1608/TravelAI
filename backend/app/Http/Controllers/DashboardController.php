<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Package;
use App\Models\Activity;
use App\Models\User;
use App\Models\Reservation;
use App\Models\AIChatLog;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $data = [
            'hotels' => Hotel::with('location')->latest()->take(5)->get(),
            'flights' => Flight::with('location')->latest()->take(5)->get(),
            'packages' => Package::latest()->take(5)->get(),
            'activities' => Activity::with('location')->latest()->take(5)->get(),
        ];

        if ($user->isAdmin()) {

            $data['users'] = User::latest()->take(5)->get();
        } else {

            $data['reservations'] = Reservation::where('user_id', $user->id)->latest()->take(5)->get();
            $data['aichatlogs'] = AIChatLog::where('user_id', $user->id)->latest()->take(5)->get();
        }

        return view('dashboard.index', compact('data'));
    }
}