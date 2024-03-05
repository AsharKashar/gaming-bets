<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTournamentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_tournament_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_tournament_id')->unsigned();
            $table->string('email');
            $table->boolean('bomb_payed')->default(false);

            $table->foreign('team_tournament_id')->references('id')->on('team_tournament')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_tournament_users');
    }
}
