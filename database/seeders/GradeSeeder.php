<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([[
            'id'=>1,
            'name'=>'Form 1',
            'school_id'=>'1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>2,
            'name'=>'Form 2',
            'school_id'=>'1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>3,
            'name'=>'Form 3',
            'school_id'=>'1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>4,
            'name'=>'Form 4',
            'school_id'=>'1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>5,
            'name'=>'Form 1',
            'school_id'=>'2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>6,
            'name'=>'Form 2',
            'school_id'=>'2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>7,
            'name'=>'Form 3',
            'school_id'=>'2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>8,
            'name'=>'Form 4',
            'school_id'=>'2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    [
            'id'=>9,
            'name'=>'Form 1',
            'school_id'=>'3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
     [
            'id'=>10,
            'name'=>'Form 2',
            'school_id'=>'3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
     [
            'id'=>11,
            'name'=>'Form 3',
            'school_id'=>'3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
     [
            'id'=>12,
            'name'=>'Form 4',
            'school_id'=>'3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
]);
    }
}
