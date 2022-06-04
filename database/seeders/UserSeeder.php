<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
              DB::table('users')->insert([
                 [
            'id'=>1,
            'firstname'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin1234'),
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    // [
    //          'id'=>2,
    //         'firstname'=>'teacher',
    //         'email'=>'teacher@gmail.com',
    //         'school_id' => 1,
    //         'password'=>bcrypt('12345678'),
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    //  ],
    // [
    //         'id'=>3,
    //         'firstname'=>'teacheronduty',
    //         'email'=>'teacheronduty@gmail.com',
    //         'school_id' => 1,
    //         'password'=>bcrypt('12345678'),
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],
    // [
    //        'id'=>4,
    //         'firstname'=>'headteacher',
    //         'email'=>'headteacher@gmail.com',
    //         'school_id' => 1,
    //         'password'=>bcrypt('12345678'),
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    //   ],
    //    [
    //        'id'=>5,
    //         'firstname'=>'wardofficer',
    //         'email'=>'wardofficer@gmail.com',
    //         'ward_id' => 1,
    //         'password'=>bcrypt('12345678'),
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    //   ],
    //    [
    //        'id'=>6,
    //         'firstname'=>'districtofficer',
    //         'email'=>'districtofficer@gmail.com',
    //         'district_id' => 1,
    //         'password'=>bcrypt('12345678'),
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    //     ]
    ]);
    }
}
