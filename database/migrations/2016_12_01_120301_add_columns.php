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
            
        });

        DB::table('applicants')->insert(
            [
                'id'    => 1,
                'student_id'  => 403410001,
                'semester_id' => 1,
                'department_id' => 2,
                'reduce_tuition_percentage' => 50,
                'reduce_miscellaneousFees_percentage' => 50,
                'reduce_accommodation_percentage' => 50,
                'chinese_name'  => "哈哈哈",
                'english_name'  => "Bear",
                'nationality'  => 0,
                'sex'  => 0,
                'passport_number'  => "AJD444884",
                'ARC_number'  => "AJD444884",
                'phone_number'  => "0999999999",
                'birthday'  => '2016-11-20 10:11:00',
                'address'  => "地址",
                'pastScholarship'  => "4",
                'how_long'  => "10",

                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ]
        );
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
