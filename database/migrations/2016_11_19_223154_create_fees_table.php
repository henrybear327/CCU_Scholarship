<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('fee_id');

            $table->unsignedInteger('semester_id');
            $table->foreign('semester_id')->references('semester_id')->on('semesters');

            $table->unsignedInteger('college_id');
            $table->foreign('college_id')->references('college_id')->on('colleges');

            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('department_id')->on('departments');

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
        Schema::dropIfExists('fees');
    }
}
