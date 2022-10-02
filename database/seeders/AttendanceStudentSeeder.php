<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance_student')->insert([[
            "attendance_id" => "1",
            'student_id'=> "1",
            "grade" => "Standard One",
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
        "attendance_id" => "2",
        'student_id'=> "2",
        "grade" => "Standard Two",
        'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
]]);
    }
}
