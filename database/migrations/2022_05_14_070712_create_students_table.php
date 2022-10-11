<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
           $table->id();
            $table->string('student_name');
            $table->string('gender');
            $table->foreignId('stream_id')
                  ->constrained('streams')
                  ->onDelete('cascade');
            $table->foreignId('school_id')
                  ->constrained('schools')
                  ->onDelete('cascade');
            $table->foreignId('final_year_id')
                   ->constrained('final_years')
                   ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
