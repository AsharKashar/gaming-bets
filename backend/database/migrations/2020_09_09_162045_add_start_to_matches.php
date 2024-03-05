<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartToMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            //
            $table->dropColumn('start_at');
            $table->dropColumn('status');
        });

        Schema::table('matches', function (Blueprint $table) {
            $table->dateTime('start_at')->nullable()->after('team_2');
            $table->integer('status')->after('winner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            //
            $table->dropColumn('start_at');
            $table->dropColumn('status');
        });
    }
}
