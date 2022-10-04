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
            'student_name'=>'student1 Amina',
            'gender'=>'female',
            'stream_id'=>'1',
            'school_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>2,
            'student_name'=>'student2 Salumu',
            'gender'=>'male',
            'stream_id'=>'1',
            'school_id' => '1'
    ],
    [
            'id'=>3,
            'student_name'=>'Abu Abu',
            'gender'=>'male',
            'stream_id'=>'2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>4,
            'student_name'=>'Klaty Asana',
            'gender'=>'female',
            'stream_id'=>'2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>5,
            'student_name'=>'Charlie Charlie',
            'gender'=>'male',
            'stream_id'=>'1',
            'school_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>6,
            'student_name'=>'Lou Charlie',
            'gender'=>'female',
            'stream_id'=>'2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>7,
            'student_name'=>'Parker Json',
            'gender'=>'male',
            'stream_id'=>'1',
            'school_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>8,
            'student_name'=>'Athur Athens',
            'gender'=>'male',
            'stream_id'=>'1',
            'school_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>9,
            'student_name'=>'Lisamu Hitler',
            'gender'=>'female',
            'stream_id'=>'1',
            'school_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
     [
            'id'=>10,
            'student_name'=>'Stregomena Tax',
            'gender'=>'female',
            'stream_id'=>'1',
            'school_id' => '1',
                        'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
     [
            'id'=>11,
            'student_name'=>'Bashungwa Innocent',
            'gender'=>'male',
            'stream_id'=>'1',
            'school_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
     [
            'id'=>12,
            'student_name'=>'Jafo Sulemani',
            'gender'=>'male',
            'stream_id'=>'1',
            'school_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
]);
    }
}
