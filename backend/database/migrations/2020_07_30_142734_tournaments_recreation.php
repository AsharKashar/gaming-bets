<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TournamentsRecreation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('first_prize');
            $table->dropColumn('second_prize');
            $table->dropColumn('third_prize');
            $table->dropColumn('first_points');
            $table->dropColumn('second_points');
            $table->dropColumn('third_points');
            $table->dropColumn('platform_type_id');
            $table->dropColumn('status');
            $table->dropColumn('game_mode_type_id');
            $table->dropColumn('team_size');
            $table->dropColumn('regions');
            $table->dropColumn('type');
            $table->dropColumn('top_players');
            $table->dropColumn('per_match');
            $table->dropColumn('rounds_finished');
            $table->dropColumn('started_at');
            $table->dropColumn('repeat_type_id');
            $table->dropColumn('game_type');
            $table->dropColumn('match_set');
            $table->dropColumn('bracket_size');
            $table->dropColumn('bracket_type');

            $table->longText('overview')->nullable()->after('description');
            $table->integer('type_id')->after('overview');
            $table->integer('status_id')->after('type_id');
            $table->integer('frequency_id')->after('status_id');
            $table->integer('bracket_type_id')->after('frequency_id');
            $table->integer('bracket_size_id')->nullable()->after('bracket_type_id');
            $table->integer('team_size_id')->nullable()->after('bracket_size_id');
            $table->integer('game_mode_id')->after('team_size_id');
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
