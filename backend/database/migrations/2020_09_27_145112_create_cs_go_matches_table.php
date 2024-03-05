<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsGoMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('dat_host_cs_go_matches', function (Blueprint $table) {
//            $table->id();
//
//            $table->integer('dat_host_match_id')->nullable();
//            $table->integer('connect_time')->default(300);
//            $table->string('match_end_webhook_url')->nullable();
//            $table->string('round_end_webhook_url')->nullable();
//            $table->longText('spectator_steam_ids')->nullable();
//            $table->longText('team1_steam_ids')->nullable();
//            $table->longText('team2_steam_ids')->nullable();
//            $table->longText('webhook_authorization_header')->nullable();
//            $table->boolean('finished')->default(false);
//            $table->longText('cancel_reason')->nullable();
//            $table->integer('rounds_played')->default(0);
//            $table->json('team1_stats')->nullable();
//            $table->json('team2_stats')->nullable();
//            $table->json('player_stats')->nullable();
//
//
//
//
//            $table->unsignedBigInteger('match_team1_id');
//            $table->foreign('match_team1_id')->references('id')->on('match_teams');
//
//            $table->unsignedBigInteger('match_team2_id');
//            $table->foreign('match_team1_id')->references('id')->on('match_teams');
//
//            $table->unsignedBigInteger('dat_host_cs_go_server_id');
//            $table->foreign('dat_host_cs_go_server_id')->references('id')->on('dat_host_cs_go_servers');
//
//
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_go_matches');
    }
}
