<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('team_id');
            $table->string("name");
            $table->integer("size");
            $table->string("token");
            $table->bigInteger("current_rank")->default(0);
            $table->bigInteger("total_rank")->default(0);
            $table->bigInteger("total_win")->default(0);
            $table->bigInteger("points_earned")->default(0);
            $table->decimal("win_ratio",3,1)->default(0);
            $table->bigInteger("team_list")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
