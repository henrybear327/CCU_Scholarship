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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'chinese_name' => '理學院',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'chinese_name' => '社會科學院',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'chinese_name' => '工學院',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'chinese_name' => '管理學院',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'chinese_name' => '法學院',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'chinese_name' => '教育學院',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
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
