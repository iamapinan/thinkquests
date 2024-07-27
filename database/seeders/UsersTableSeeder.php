<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                'name' => 'Super Admin',
                'email' => 'admin@thinkquests.com',
                'password' => bcrypt('123456'),
                'role_id' => 2,
                'organization_id' => 1,
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
