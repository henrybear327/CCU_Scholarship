<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class PopulateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

        DB::table('fees')->insert(
            [
                'semester_id' => 1,
                'college_id' => 2,
                'tuition_base' => 10000,
                'miscellaneousFees_base' => 15000,
                'accommodation_base' => 20000,
                'cost_of_living_base' => 20000,
                'created_at' => '2016-11-20 10:11:00',
                'updated_at' => '2016-11-20 10:11:00',
            ]
        );

        DB::table('bulletinBoard')->insert([
            [
                'title' => "標題一",
                'content' => "內文一",
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'title' => "標題二",
                'content' => "內文二",
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => "admin@a.a",
            'password' => '$2y$10$MTSHAJrzMQBAacruqaAMout2nQcS18.fFruEFzOEJxIkuA94zyrl.',
            'created_at' => '2016-11-20 10:11:00',
            'updated_at' => '2016-11-20 10:11:00',
            'user_type' => '3',
        ]);
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
