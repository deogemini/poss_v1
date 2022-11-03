<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumninTODremarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('t_o_dremarks', function (Blueprint $table) {
        //     $table->integer('approvedbyHeadMaster')->default('0');
        //     $table->integer('rejectedbyHeadMaster')->default('0');
        //     $table->integer('pendingbyHeadMaster')->default('0');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('t_o_dremarks', function (Blueprint $table) {
        //     $table->dropColumn('approvedbyHeadMaster');
        //     $table->dropColumn('rejectedbyHeadMaster');
        //     $table->dropColumn('pendingbyHeadMaster');
        // });
    }
}
