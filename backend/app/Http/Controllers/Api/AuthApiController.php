<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Google_Client;
use Exception;

class AuthApiController extends Controller
{
    use ApiResponse;

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string',
            'role_id' => 'nullable|exists:roles,id'
        ]);

        $validated['role_id'] = Role::where('name', Role::USER)->value('id');
        $validated['password'] = Hash::make($request->password);
        $validated['status'] = 'active';

        $user = User::create($validated);
        $token = $user->createToken('api-token')->plainTextToken;
        $user->load(['role', 'preferences']);

        return $this->success([
            'token' => $token,
            'user'  => new UserResource($user)
        ], 'Usuario registrado con éxito', 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error('Credenciales incorrectas', 401);
        }

        if ($user->status !== 'active') {
            return $this->error('Tu cuenta no está activa. Contacta con soporte.', 403);
        }

        $user->tokens()->delete();
        $token = $user->createToken('api-token')->plainTextToken;
        $user->load(['role', 'preferences']);

        return $this->success([
            'token' => $token,
            'user'  => new UserResource($user)
        ], 'Login correcto');
    }

    public function googleLogin(Request $request)
    {
        $request->validate(['token' => 'required|string']);

        try {
            $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
            $payload = $client->verifyIdToken($request->token);

            if (!$payload) {
                return $this->error('Token de Google no válido', 401);
            }

            $user = User::where('email', $payload['email'])->first();

            if (!$user) {
                $user = User::create([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                    'password' => Hash::make(bin2hex(random_bytes(10))),
                    'phone_number' => 'Cuenta de Google',
                    'role_id' => Role::where('name', Role::USER)->value('id'),
                    'status' => 'active',
                ]);
            }

            if ($user->status !== 'active') {
                return $this->error('Usuario suspendido', 403);
            }

            $user->tokens()->delete();
            $token = $user->createToken('api-token')->plainTextToken;
            $user->load(['role', 'preferences']);

            return $this->success([
                'token' => $token,
                'user'  => new UserResource($user)
            ], 'Autenticado con Google');
        } catch (Exception $e) {
            return $this->error('Error de servidor: ' . $e->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Sesión cerrada');
    }

    public function user(Request $request)
    {
        try {
            $user = $request->user()->fresh()->load(['role', 'preferences']);
            return $this->success(new UserResource($user), 'Datos del usuario recuperados');
        } catch (\Exception $e) {
            return $this->error('Error al recuperar el perfil: ' . $e->getMessage(), 500);
        }
    }
}