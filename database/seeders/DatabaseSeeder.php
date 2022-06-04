<?php

namespace Database\Seeders;

use App\Models\AttendanceStudent;
use App\Models\AttendanceTeacher;
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
            GradeSeeder::class,
            StreamSeeder::class,
            StudentSeeder::class,
            UserSeeder::class, 
            RoleSeeder::class,
            UserRoleSeeder::class,
            AttendanceSeeder::class,
            AttendanceStudentSeeder::class,
            AttendanceTeacherSeeder::class
        ]);

    }
}
