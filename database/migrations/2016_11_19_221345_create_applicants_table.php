<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('applicant_id');

            $table->unsignedInteger('id');
            $table->foreign('id')->references('id')->on('users');

            $table->integer('student_id');

            $table->unsignedInteger('semester_id');
            $table->foreign('semester_id')->references('semester_id')->on('semesters');

            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('department_id')->on('departments');

            $table->integer('reduce_tuition_percentage')->default(0);
            $table->integer('reduce_tuition_amount')->default(-1); //預設先用百分比

            $table->integer('reduce_miscellaneousFees_percentage')->default(0);
            $table->integer('reduce_miscellaneousFees_amount')->default(-1);

            $table->integer('reduce_accommodation_percentage')->default(0);
            $table->integer('reduce_accommodation_amount')->default(-1);

            $table->integer('livingExpense_amount')->default(0);

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
        Schema::dropIfExists('applicants');
    }
}
