<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserScore;
use Carbon\Carbon;

class UserScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserScore::insert([
            [
                'user_id' => 1, // Assuming this user ID exists in the users table
                'content_id' => 1, // Assuming this content ID exists in the contents table
                'score' => 95,
                'timestamp' => Carbon::now()->subMinutes(10)->toDateTimeString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1, // Assuming this user ID exists in the users table
                'content_id' => 1, // Assuming this content ID exists in the contents table
                'score' => 88,
                'timestamp' => Carbon::now()->subMinutes(20)->toDateTimeString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            // Add more mock data here
        ]);
    }
}