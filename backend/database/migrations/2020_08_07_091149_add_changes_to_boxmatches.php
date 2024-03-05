<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangesToBoxmatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('box_matches', function (Blueprint $table) {
            //
            $table->dropColumn('game_type');
            $table->dropColumn('platform');
            $table->dropColumn('region');
            $table->integer('region_id')->after('bid_amount');
            $table->integer('platform_id')->after('bid_amount');
            $table->integer('game_type_boxmatch_id')->after('bid_amount');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('box_matches', function (Blueprint $table) {
            //
            $table->dropColumn('region_id');
            $table->dropColumn('platform_id');
            $table->dropColumn('game_type_boxmatch_id');
        });
    }
}
