<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSystemStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('systemStatus', function (Blueprint $table) {
            $table->dropColumn('current_stage');

            $table->dateTime('start_apply_datetime')->nullable();
            $table->dateTime('end_apply_datetime')->nullable();
            $table->dateTime('start_review_datetime')->nullable();
            $table->dateTime('end_review_datetime')->nullable();
            $table->dateTime('start_show_result_datetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('systemStatus', function (Blueprint $table) {
            //
        });
    }
}
