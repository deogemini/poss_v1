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
            'name'=>'Form One'
    ],
    [
            'id'=>2,
            'name'=>'Form Two'

    ],
    [
            'id'=>3,
            'name'=>'Form Three'
    ],
    [
            'id'=>4,
            'name'=>'Form Four'
           
    ],
    [
            'id'=>5,
            'name'=>'Standard One'
           
    ],
    [
            'id'=>6,
            'name'=>'Standard Two'
           
    ],
    [
            'id'=>7,
            'name'=>'Standard Three'
           
    ],
    [
            'id'=>8,
            'name'=>'Standard Four'
           
    ],
    [
            'id'=>9,
            'name'=>'Standard Five'
          
    ],
     [
            'id'=>10,
            'name'=>'Standard Six'
          
    ],
     [
            'id'=>11,
            'name'=>'Standard Seven'
          
    ]
]);
    }
}
