<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(LevelsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        // $this->call(ContentsTableSeeder::class);
        // $this->call(UserScoresTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OrganizationSeeder::class);
    }
}
