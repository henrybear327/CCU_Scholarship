<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('caps', function (Blueprint $table) {
          $table->increments('cap_id');

          $table->unsignedInteger('semester_id');
          $table->foreign('semester_id')->references('semester_id')->on('semesters');

          $table->unsignedInteger('college_id')->nullable();
          $table->foreign('college_id')->references('college_id')->on('colleges');

          $table->unsignedInteger('department_id')->nullable();
          $table->foreign('department_id')->references('department_id')->on('departments');

          // 上限
          $table->integer('tuition_cap');
          $table->integer('miscellaneousFees_cap');
          $table->integer('accommodation_cap');
          $table->integer('cost_of_living_cap');

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
          Schema::dropIfExists('caps');
    }
}
