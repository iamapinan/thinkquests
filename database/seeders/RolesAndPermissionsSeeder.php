<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define roles
        $roles = ['User', 'Teacher', 'Admin'];

        // Define default permissions for each role
        $defaultPermissions = [
            'read' => false,
            'upload' => false,
            'delete_content' => false,
            'update' => false,
            'list' => false,
            'delete_user' => false,
            'view_activities' => false,
            'view_activities_logs' => false,
        ];

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            Permission::firstOrCreate(array_merge(['role_id' => $role->id], $defaultPermissions));
        }
    }
}