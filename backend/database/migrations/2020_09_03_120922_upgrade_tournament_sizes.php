<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpgradeTournamentSizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournament_sizes', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->after('id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });

        Schema::dropIfExists('tournament_size_limits');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournament_sizes', function (Blueprint $table) {
            if (Schema::hasColumn('tournament_sizes', 'game_id')) {
                $table->dropColumn('game_id');
            }
        });
    }
}
