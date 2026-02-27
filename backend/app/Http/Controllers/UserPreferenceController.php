<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use App\Http\Requests\UserPreferenceReq\UserPreferenceRequest;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {

            $preferences = UserPreference::with('user')->get();
            return view('userPreferences.index', compact('preferences'));
        }

        $preference = auth()->user()->preferences;

        return view('userPreferences.form', compact('preference'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPreferenceRequest $request)
    {
        UserPreference::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->validated()
        );

        return redirect()->route('dashboard')->with('success', '¡Preferencias actualizadas con éxito!');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPreference $userPreference)
    {
        $this->authorize('delete', $userPreference);
        $userPreference->delete();

        return redirect()->route('userPreferences.index')->with('success', 'Preferencias eliminadas');
    }
}
