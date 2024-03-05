<?php

use App\Model\Game;
use App\Model\GameMode;
use App\Model\GameType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class GameTypeUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Game::all()->each->delete();
        GameType::all()->each->delete();
        GameMode::all()->each->delete();

        GameType::create([
            'name' => 'Solo'
        ]);

        GameType::create([
            'name' => 'Duo'
        ]);

        GameType::create([
            'name' => 'Squad',
        ]);


        Schema::table('game_modes', function (Blueprint $table) {
            $table->dropColumn('size');
            $table->string('preview_img')->nullable();
        });

        GameMode::create([
            'name' => 'Battle Royale',
            'preview_img' => 'https://cdn.bangergames.com/demo-files/battle_royale_demo-min.jpg'
        ]);

        GameMode::create([
            'name' => 'Box Fight',
            'preview_img' => 'https://cdn.bangergames.com/demo-files/box-fight-demo-min.jpg'
        ]);

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('match_type_id');

            $table->integer('game_type_id')->nullable()->after('hosted_by');
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
