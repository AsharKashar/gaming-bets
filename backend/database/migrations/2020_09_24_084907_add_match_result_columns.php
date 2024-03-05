<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatchResultColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_teams', function (Blueprint $table) {
            $table->text('result_data')->nullable();
            $table->bigInteger('score')->nullable();
        });
        Schema::table('match_users', function (Blueprint $table) {
            $table->text('result_data')->nullable();
            $table->bigInteger('kills')->nullable();
            $table->bigInteger('deaths')->nullable();
            $table->bigInteger('assists')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
