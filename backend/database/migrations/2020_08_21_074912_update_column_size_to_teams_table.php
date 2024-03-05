<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Model\TeamSize;
use \App\Model\Team;

class UpdateColumnSizeToTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {

            if (Schema::hasColumn('teams', 'size'))
            {
                $table->dropColumn('size');
            }

            if (!Schema::hasColumn('teams', 'team_size_id'))
            {
                $table->bigInteger('team_size_id')->after('owner_id');
            }
        });

        $teamSizeIds = TeamSize::all()->pluck('id')->toArray();

        Team::all()->map(function ($team) use ($teamSizeIds){
            $team->update([
                'team_size_id' => $teamSizeIds[array_rand($teamSizeIds)]
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('team_size_id');
            $table->integer('size');
        });
    }
}
