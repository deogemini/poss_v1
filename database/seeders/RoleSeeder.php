<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          DB::table('roles')->insert([[
            'id'=>1,
            'name'=>'isAdmin',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ]
    // ,
    // [
    //         'id'=>2,
    //         'name'=>'isTeacher',
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],
    // [
    //         'id'=>3,
    //         'name'=>'isTeacherOnDuty',
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],
    // [
    //         'id'=>4,
    //         'name'=>'isHeadTeacher',
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],
    // [
    //         'id'=>5,
    //         'name'=>'isWardOfficer',
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],
    // [
    //         'id'=>6,
    //         'name'=>'isDistrictOfficer',
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],
    // [
    //         'id'=>7,
    //         'name'=>'isReseacher',
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],

    ]);

    }
}
