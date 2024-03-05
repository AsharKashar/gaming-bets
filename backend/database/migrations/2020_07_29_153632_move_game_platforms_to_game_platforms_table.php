<?php

use App\Model\GamePlatform;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveGamePlatformsToGamePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        GamePlatform::create([
            'name' => 'Xbox',
            'type' => 'xbox'
        ]);

        GamePlatform::create([
            'name' => 'Playstation',
            'type' => 'ps'
        ]);

        GamePlatform::create([
            'name' => 'PC',
            'type' => 'pc'
        ]);

        GamePlatform::create([
            'name' => 'All platforms',
            'type' => 'all'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        GamePlatform::truncate();
    }
}
