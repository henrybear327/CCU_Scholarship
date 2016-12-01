<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('bulletinBoard')->insert([
            [
                'title' => "標題一",
                'content' => "內文一",
            ],
            [
                'title' => "標題二",
                'content' => "內文二",
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
