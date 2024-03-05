<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReplaceTournamentStringTypesToRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->string('platform_type_id')->after('platforms')->nullable();
            $table->string('game_mode_type_id')->after('game_mode')->nullable();
            $table->string('match_type_id')->after('match_type')->nullable();
            $table->string('repeat_type_id')->after('repeat')->nullable();
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('platforms');
            $table->dropColumn('game_mode');
            $table->dropColumn('match_type');
            $table->dropColumn('repeat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('platform_type_id');
            $table->dropColumn('game_type_id');
            $table->dropColumn('match_type_id');
            $table->dropColumn('repeat_type_id');
        });
    }
}
