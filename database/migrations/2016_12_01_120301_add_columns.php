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
            $table->integer('Identity')->default(-1);
            $table->string('Chinese_name')->default("No Chinese Name");
            $table->string('English_name')->default("No English Name");
            $table->string('Nationality')->default("No Nationality");
            $table->integer('Sex')->default(-1);
            $table->string('Passport_number')->default('No Passport Number');
            $table->string('ARC_number')->default('No ARC Number');
            $table->string('Phone_number')->default('No Phone Number');
            $table->date('Birthday')->default('0000-00-00');
            $table->string('Address')->default('Homeless');
            $table->string('Email')->default('No Email');
            $table->integer('PastScholarship')->default(-1);
            $table->integer('How_long')->default(-1);
            $table->integer('status')->default(-1);
            $table->string('hash')->default('No hash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
