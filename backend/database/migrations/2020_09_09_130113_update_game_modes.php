<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGameModes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_modes', function (Blueprint $table) {
            $table->unsignedBigInteger('match_limits_id')->after('game_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_modes', function (Blueprint $table) {
            if (Schema::hasColumn('game_modes', 'match_limits_id'))
            {
                $table->dropColumn('match_limits_id');
            }
        });
    }
}
