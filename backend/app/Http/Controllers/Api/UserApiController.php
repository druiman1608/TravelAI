<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserApiController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return UserResource::collection($users);
    }

    public function profileSummary()
    {
        $user = Auth::user();

        $user->load(['role', 'preferences']);
        $user->loadCount(['reservations', 'reviews']);

        return response()->json([
            'status' => 'success',
            'data'   => new UserResource($user)
        ]);
    }

    public function store(\App\Http\Requests\UserReq\UserRequest $request)
    {
        try {
            $user = User::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'password'     => bcrypt($request->password),
                'role_id'      => $request->input('role_id', Role::where('name', Role::USER)->value('id')),
                'status'       => $request->input('status', 'active'),
                'phone_number' => $request->input('phone_number', ''),
            ]);

            return response()->json([
                'status' => 'success',
                'data'   => new UserResource($user)
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->name = $request->input('nombre', $user->name);
            $user->email = $request->input('email', $user->email);
            $user->phone_number = $request->input('telefono', $user->phone_number);

            $user->role_id = $request->input('role_id', $request->input('rol_id', $user->role_id));

            $user->status = $request->input('status', $request->input('estado', $user->status));

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return response()->json([
                'status' => 'success',
                'data' => new UserResource($user)
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateMe(Request $request)
    {
        $user = Auth::user();

        $user->name         = $request->input('nombre', $user->name);
        $user->email        = $request->input('email', $user->email);
        $user->phone_number = $request->input('telefono', $user->phone_number);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'data'   => new UserResource($user->load('preferences'))
        ]);
    }

    public function becomePremium(Request $request)
    {
        $user = Auth::user();
        $premiumRole = Role::where('name', Role::PREMIUM)->first();

        if (!$premiumRole) {
            return response()->json(['message' => 'Rol Premium no encontrado.'], 500);
        }

        $user->role_id = $premiumRole->id;
        $user->save();

        return response()->json([
            'status' => 'success',
            'data'   => new UserResource($user->load('role', 'preferences'))
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['profile_photo_path' => $path]);

        return response()->json([
            'status' => 'success',
            'url' => asset('storage/' . $path)
        ]);
    }

    public function destroy(int $id)
    {
        User::destroy($id);
        return response()->json(['message' => 'Usuario eliminado']);
    }

    public function destroyMe(Request $request)
    {
        try {
            $user = $request->user();

            $user->preferences()->delete();

            $user->reviews()->delete();
            $user->reservations()->delete();

            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Tu cuenta ha sido eliminada permanentemente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la cuenta: ' . $e->getMessage()
            ], 500);
        }
    }
}