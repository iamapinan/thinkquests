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
            ['name' => 'อนุบาล 3'],
            ['name' => 'ประถมศึกษาปีที่ 1'],
            ['name' => 'ประถมศึกษาปีที่ 2'],
            ['name' => 'ประถมศึกษาปีที่ 3'],
            ['name' => 'ประถมศึกษาปีที่ 4'],
            ['name' => 'ประถมศึกษาปีที่ 5'],
            ['name' => 'ประถมศึกษาปีที่ 6'],
            ['name' => 'มัธยมศึกษาปีที่ 1'],
            ['name' => 'มัธยมศึกษาปีที่ 2'],
            ['name' => 'มัธยมศึกษาปีที่ 3'],
            ['name' => 'มัธยมศึกษาปีที่ 4'],
            ['name' => 'มัธยมศึกษาปีที่ 5'],
            ['name' => 'มัธยมศึกษาปีที่ 6'],
        ];

        DB::table('levels')->insert($levels);
    }
}