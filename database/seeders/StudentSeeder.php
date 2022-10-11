<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        DB::table('students')->insert([[
            'id'=>1,
            'student_name'=>'sample student',
            'gender'=>'female',
            'stream_id'=>'1',
            'final_year_id'=>'1',
            'school_id' => '1'
    ],
    [
            'id'=>2,
            'student_name'=>'sample student2',
            'gender'=>'male',
            'stream_id'=>'2',
            'final_year_id'=>'1',
            'school_id' => '1'
    ]
]);
    }
}
