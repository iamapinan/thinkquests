<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;
use Carbon\Carbon;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Content::insert([
            [
                'subject_topic' => 'Mathematics',
                'content_details' => 'Introduction to Algebra',
                'content_indicators' => 'Understand basic algebraic concepts',
                'plan' => NULL,
                'score' => 0,
                'grade' => 10,
                'category' => 1,
                'cover_image' => 'images/algebra.jpg',
                'video_pdf' => 'videos/algebra.pdf',
                'e_testing' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subject_topic' => 'Science',
                'content_details' => 'Introduction to Physics',
                'content_indicators' => 'Understand basic physics concepts',
                'plan' => NULL,
                'score' => 0,
                'grade' => 10,
                'category' => 2,
                'cover_image' => 'images/physics.jpg',
                'video_pdf' => 'videos/physics.pdf',
                'e_testing' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subject_topic' => 'History',
                'content_details' => 'World War II',
                'content_indicators' => 'Learn about the events of World War II',
                'score' => 0,
                'plan' => NULL,
                'grade' => 10,
                'category' => 3,
                'cover_image' => 'images/ww2.jpg',
                'video_pdf' => 'videos/ww2.pdf',
                'e_testing' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more mock data here
        ]);
    }
}