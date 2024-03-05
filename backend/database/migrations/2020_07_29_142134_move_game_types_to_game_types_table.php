<?php

use App\Model\GameType;
use Illuminate\Database\Migrations\Migration;

class MoveGameTypesToGameTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        GameType::create([
            'name' => 'Strategy'
        ]);
        GameType::create([
            'name' => 'Shooter'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        GameType::truncate();
    }
}
