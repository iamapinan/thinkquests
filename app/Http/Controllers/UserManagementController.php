<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('role', 'User');
        $users = User::where('role_id', $role)->paginate(10);
        return view('user-management.index', compact('users', 'role'));
    }

    public function create()
    {
        return view('user-management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:User,Teacher,Admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.management')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user-management.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:User,Teacher,Admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('user.management')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.management')->with('success', 'User deleted successfully.');
    }

    public function resetPassword(User $user)
    {
        $user->password = Hash::make('newpassword');
        $user->save();
        return redirect()->route('user.management')->with('success', 'Password reset successfully.');
    }

    public function suspend(User $user)
    {
        $user->suspended = !$user->suspended;
        $user->save();
        return redirect()->route('user.management')->with('success', 'User suspension status changed.');
    }

    /**
     * Search users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $role = $request->query('role', 'all');
        $search = $request->query('search', '');
        $sortBy = $request->query('sort_by', 'name');
        $order = $request->query('order', 'asc');

        $users = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->when($role !== 'all', function ($query) use ($role) {
                return $query->where('roles.name', $role);
            })
            ->where(function ($query) use ($search) {
                $query->where('users.name', 'like', "%$search%")
                      ->orWhere('users.email', 'like', "%$search%");
            })
            ->orderBy($sortBy, $order)
            ->select('users.*', 'roles.name as role_name')
            ->paginate(10);

        return response()->json([
            'users' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'total_pages' => $users->lastPage(),
            ],
        ]);
    }
}