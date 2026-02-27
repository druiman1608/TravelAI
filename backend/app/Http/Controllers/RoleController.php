<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\RoleReq\RoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(RoleRequest $request)
    {
        Role::create($request->validated());
        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function show(Role $role)
    {
        $role->load('users');
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {

        if ($role->name === 'Administrador' || $role->name === 'admin') {
            return redirect()->route('roles.index')->with('error', 'No puedes borrar el rol de Administrador.');
        }

        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado.');
    }
}
