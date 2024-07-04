<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Science'],
            ['name' => 'Mathematics'],
            ['name' => 'History'],
            ['name' => 'Geography'],
            ['name' => 'Arts'],
            ['name' => 'Physical Education'],
            ['name' => 'Language Arts'],
            ['name' => 'Music'],
            ['name' => 'Computer Science'],
        ];

        DB::table('categories')->insert($categories);
    }
}