<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemStatus', function (Blueprint $table) {
            $table->increments('system_status_id');

            $table->unsignedInteger('semester_id');
            $table->foreign('semester_id')->references('semester_id')->on('semesters');

            $table->integer('event_type');

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
        Schema::dropIfExists('systemStatus');
    }
}
