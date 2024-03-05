<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMatchTeamRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_team_relation', function (Blueprint $table) {
            $table->string('e_image')->nullable();
            $table->string('e_video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_team_relation', function (Blueprint $table) {
            $table->dropColumn(['e_image','e_video']);
        });
    }
}
