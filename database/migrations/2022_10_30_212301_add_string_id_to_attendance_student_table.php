<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStringIdToAttendanceStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('attendance_student', function (Blueprint $table) {
        //     $table->string('stream_id');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('attendance_student', function (Blueprint $table) {
        //     $table->dropColumn('stream_id');
        // });
    }
}
