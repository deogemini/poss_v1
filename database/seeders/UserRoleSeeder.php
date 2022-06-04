<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('role_user')->insert([[
            'role_id'=>1,
            'user_id'=>1,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    ],
    // [
    //          'role_id'=>2,
    //         'user_id'=>2,
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],
    // [
    //        'role_id'=>3,
    //         'user_id'=>3,
    //         'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
    //         'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
    // ],
//     [
//               'role_id'=>4,
//             'user_id'=>4,
//             'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
//             'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
//      ],
//      [
//               'role_id'=>5,
//             'user_id'=>5,
//             'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
//             'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
//      ],
//      [
//               'role_id'=>6,
//             'user_id'=>6,
//             'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
//             'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
//      ],
//      [
//               'role_id'=>6,
//             'user_id'=>7,
//             'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
//             'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
//      ],
//      [
//               'role_id'=>5,
//             'user_id'=>8,
//             'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
//             'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
//      ]
    ]);
    }
}
