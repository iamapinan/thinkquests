<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        return view('permission.index');
    }
    public function getPermissions($role)
    {
        // Fetch permissions from database based on role
        $permissions = Permission::where('role', $role)->first();

        if (!$permissions) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json($permissions);
    }

    public function updatePermissions(Request $request, $role)
    {
        // Validate the request
        $request->validate([
            'read' => 'required|boolean',
            'upload' => 'required|boolean',
            'delete_content' => 'required|boolean',
            'update' => 'required|boolean',
            'list' => 'required|boolean',
            'delete_user' => 'required|boolean',
            'view_activities' => 'required|boolean',
            'view_activities_logs' => 'required|boolean',
        ]);

        // Find or create the permission record for the given role
        $permissions = Permission::updateOrCreate(
            ['role' => $role],
            $request->all()
        );

        return response()->json(['message' => 'Permissions updated successfully']);
    }
}