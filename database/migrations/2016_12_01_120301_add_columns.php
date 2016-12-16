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
            $table->integer('identity')->nullable();
            $table->string('chinese_name')->nullable();
            $table->string('english_name')->nullable();
            $table->integer('nationality')->nullable();
            $table->integer('sex')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('arc_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->integer('pastScholarship')->nullable();
            $table->integer('how_long')->nullable();
            $table->integer('status')->nullable();
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
