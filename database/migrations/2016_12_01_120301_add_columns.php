<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            //
            $table->string('Chinese_name');
            $table->string('English_name');
            $table->string('Nationality');
            $table->integer('Sex');
            $table->string('Passport_number');
            $table->string('ARC_number');
            $table->string('Phone_number');
            $table->date('Birthday');
            $table->string('Address');
            $table->integer('PastScholarship');
            $table->integer('How_long');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            //
        });
    }
}
