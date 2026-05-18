<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserPreference;
use App\Http\Resources\UserPreferenceResource;
use App\Http\Requests\UserPreferenceReq\UserPreferenceRequest;
use Illuminate\Support\Facades\Auth;

class UserPreferenceApiController extends Controller
{
    public function showMe()
    {
        $prefs = UserPreference::where('user_id', Auth::id())->first();

        if (!$prefs) {
            return response()->json(['data' => null]);
        }

        return new UserPreferenceResource($prefs);
    }

    public function store(UserPreferenceRequest $request)
    {
        $prefs = UserPreference::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->validated()
        );

        return response()->json([
            'status' => 'success',
            'data' => new UserPreferenceResource($prefs)
        ]);
    }
}