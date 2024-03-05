<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsInTeamTournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_tournament', function (Blueprint $table) {
            if (Schema::hasColumn('team_tournament', 'allowed'))
            {
                $table->dropColumn('allowed');
            }
            if (Schema::hasColumn('team_tournament', 'created_at'))
            {
                $table->dropTimestamps();
            }

            $table->unique(['team_id','tournament_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_tournament', function (Blueprint $table) {
            //
        });
    }
}
