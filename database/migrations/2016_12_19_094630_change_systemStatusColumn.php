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
            $table->date('start_apply_date')->nullable();
            $table->date('end_apply_date')->nullable();
            $table->date('start_review_date')->nullable();
            $table->date('end_review_date')->nullable();
            $table->date('start_show_result_date')->nullable();

            $table->integer('in_use')->default(0); // 1 in use, 0, not in use
            $table->integer('reviewByCollege')->default(1); // 1 true 0 false
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
