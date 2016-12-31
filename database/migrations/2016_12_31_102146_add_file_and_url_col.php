<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileAndUrlCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('systemStatus', function (Blueprint $table) {
            $table->string('attachment1')->nullable();
            $table->string('ruleURL')->default("http://oia.ccu.edu.tw/ciaeenglish/");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('systemStatus', function (Blueprint $table) {
            $table->dropColumn(['attachment1', 'ruleURL']);
        });
    }
}
