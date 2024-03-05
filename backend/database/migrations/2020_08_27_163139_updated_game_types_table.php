<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Model\GameType;
use \App\Model\TeamSize;

class UpdatedGameTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_types', function (Blueprint $table) {
            $table->bigInteger('team_size_id')->after('id')->unsigned();
        });

        $teamSizeIds = TeamSize::all()->pluck('id')->toArray();

        GameType::all()->map(function ($gameType) use ($teamSizeIds) {
           $gameType->update([
               'team_size_id' => $teamSizeIds[array_rand($teamSizeIds)],
           ]);
        });

        Schema::table('game_types', function (Blueprint $table) {
            $table->foreign('team_size_id')->references('id')->on('team_sizes');
        });

    }
}
