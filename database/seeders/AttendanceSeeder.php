<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendances')->insert([[
            "id" => "1",
            'status'=> "present",
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],[
        "id" => "2",
        'status'=> "absent",
        'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
]
]);
    }
}
