<?php

use App\Model\TeamSize;
use Illuminate\Database\Migrations\Migration;

class TeamSizesSeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        TeamSize::create([
            'name' => 'Single',
            'size' => 1
        ]);

        TeamSize::create([
            'name' => '2x2',
            'size' => 2
        ]);

        TeamSize::create([
            'name' => '5x5',
            'size' => 5
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        TeamSize::truncate();
    }
}
