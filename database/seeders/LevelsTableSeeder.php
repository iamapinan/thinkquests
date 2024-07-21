<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            ['name' => 'อนุบาล 1'],
            ['name' => 'อนุบาล 2'],
            ['name' => 'อนุบาล 3']
        ];

        DB::table('levels')->insert($levels);
    }
}