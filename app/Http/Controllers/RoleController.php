<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        // echo json_encode($roles);
        // exit;
        return view('roles.index', compact('roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('roles.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('roles.index')->with('success', 'Roles updated successfully.');
    }

    public function permissions(Role $role, User $user)
    {
        $roles = Role::where('id', '==', $role)->get();
        return view('roles.permission', compact('user', 'role'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $permissions = $role->permissions;
        $permissions->update($request->except(['_token', '_method']));
        return redirect()->route('roles.index')->with('success', 'Permissions updated successfully.');
    }
}