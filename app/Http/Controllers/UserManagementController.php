<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Organization;
// import Response class from Laravel core
use Illuminate\Support\Facades\Response;
class UserManagementController extends Controller
{
    public $defaultPassword = 'changeme';
    public function index(Request $request)
    {
        $role = $request->get('role');
        if (!$role) {
            $role = User::select('role_id')->distinct('role_id')->get()->pluck('role_id')->toArray();
        }
        $users = User::join('organizations', 'users.organization_id', '=', 'organizations.id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('role_id', $role)
            ->select('users.*', 'organizations.name as organization_name', 'roles.name as role_name')
        ->orderBy('id', 'desc')->paginate(30);
        return view('user-management.index', compact('users', 'role'));
    }

    public function create()
    {
        // get organizations
        $organizations = Organization::all();
        return view('user-management.create', compact('organizations'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'organization_id' => 'required',
            'number_of_users' => 'required',
        ]);

        $users = [];
        if ($request->organization_id && $request->number_of_users) {
            $org = Organization::find($request->organization_id);
            for ($i = 1; $i <= $request->number_of_users; $i++) {
                User::create([
                    'name' => $org->name . ' ผู้ใช้ที่ ' . $i,
                    'email' => $request->organization_id . rand(1111, 9999) . $i . '@thinkquests.com',
                    'password' => Hash::make($this->defaultPassword),
                    'role_id' => 1,
                    'organization_id' => $request->organization_id,
                ]);
            }
        } else {
            return redirect()->route('users.create')->with('error', 'Please select organization and number of users.');
        }

        return redirect()->route('users')->with('success', 'User created successfully.');
    }

    public function exportCsv(Request $request)
    {

        $users = User::join('organizations', 'users.organization_id', '=', 'organizations.id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'organizations.name as organization_name', 'roles.name as role_name')
        ->orderBy('id', 'desc')->get();

        $filename = 'users-'.date('d-m-Y').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['id', 'organization_name', 'name', 'email', 'role_name', 'status', 'created_at'];

        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, array($user->id, $user->organization_name, $user->name, $user->email, $user->role_name, $user->status ? 'Active' : 'Inactive', $user->created_at));
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }


    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);
        $escapedHeader = [];
        foreach ($header as $key => $value) {
            $escapedItem = preg_replace('/[^a-z]/', '', strtolower($value));
            array_push($escapedHeader, $escapedItem);
        }
        while ($columns = fgetcsv($file)) {
            if (count($header) != count($columns)) {
                return redirect()->route('users')->with('error', 'Invalid CSV file');
            }
            $data = array_combine($escapedHeader, $columns);
            $user = User::where('email', $data['email'])->first();
            if (!$user) {
                $user = new User();
            }

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($this->defaultPassword);
            $user->role_id = 1;
            $user->status = 1;
            $user->organization_id = $data['organizationid'];
            $user->save();
        }
        fclose($file);
        return redirect()->route('users')->with('success', 'User imported successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user-management.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);
        
        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.']);
    }

    public function resetPassword(User $user)
    {
        $user->password = Hash::make($this->defaultPassword);
        $user->save();
        return response()->json(['message' => 'Password reset successfully.']);
    }

    public function suspend(User $user)
    {
        $user->status = !$user->status;
        $user->save();
        return response()->json(['message' => 'User suspension status changed.']);
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
            ->with('organization')
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