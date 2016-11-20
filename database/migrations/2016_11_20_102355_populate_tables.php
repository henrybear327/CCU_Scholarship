<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });

        DB::table('semesters')->insert([
            [
                'year' => 2016,
                'term' => 1,
                'name' => '2016秋季班',
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ],
            [
                'year' => 2016,
                'term' => 2,
                'name' => '2016春季班',
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ]
        ]);

        DB::table('systemStatus')->insert(
            [
                'semester_id' => 1,
                'event_type' => 1,
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ]
        ); // 暫定event_type 1 = 開放申請

        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'admin@a.a',
                'password' => '$2y$10$MTSHAJrzMQBAacruqaAMout2nQcS18.fFruEFzOEJxIkuA94zyrl.',
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
                'user_type' => '3',
            ]
        );

        DB::table('colleges')->insert([
            [
                'chinese_name' => '文學院',
                'english_name' => 'College of Literature',
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ],
            [
                'chinese_name' => '工學院',
                'english_name' => 'College of Engineering',
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ]
        ]);

        DB::table('departments')->insert([
            [
                'college_id'    => 1,
                'chinese_name' => '外文系',
                'english_name' => 'Department of foreign literature',
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ],
            [
                'college_id'    => 2,
                'chinese_name' => '資工系',
                'english_name' => 'Department of computer science and information engineering',
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ]
        ]);

        DB::table('applicants')->insert(
            [
                'id'    => 1,
                'semester_id' => 1,
                'department_id' => 2,
                'reduce_tuition_percentage' => 50,
                'reduce_miscellaneousFees_percentage' => 50,
                'reduce_accommodation_percentage' => 50,
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ]
        );

        DB::table('fees')->insert(
            [
                'semester_id' => 1,
                'college_id' => 2,
                'tuition_base' => 10000,
                'miscellaneousFees_base' => 15000,
                'accommodation_base' => 20000,
                'tuition_cap' => 1000000,
                'miscellaneousFees_cap' => 2000000,
                'accommodation_cap' => 3000000,
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
