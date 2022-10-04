<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RegionSeeder::class,
            DistrictSeeder::class,
            WardSeeder::class,
            SchoolSeeder::class,                              
            StreamSeeder::class,
            GradeSeeder::class,
            UserSeeder::class, 
            RoleSeeder::class,
            UserRoleSeeder::class,
            AttendanceSeeder::class,
            FinalYearSeeder::class
            // AttendanceStudentSeeder::class,
        ]);

    }
}
