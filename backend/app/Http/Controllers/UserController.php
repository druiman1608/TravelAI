<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserReq\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('users.index')->with('success', 'Usuario creado.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        if ($user->id === Auth::id()) {
            $adminRole = Role::where('name', 'Administrador')->first();
            if ($request->role_id != $adminRole->id) {
                return back()->withErrors(['role' => 'ERROR: No puedes quitarte el rango de Administrador a ti mismo para no perder el acceso.']);
            }
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->withErrors(['destroy' => 'ERROR: No puedes eliminar tu propia cuenta mientras estés en sesión.']);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado del sistema.');
    }
}