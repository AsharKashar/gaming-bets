<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatchEndTimeToBoxMatches extends Migration
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
            $table->timestamp('matchEnd_time')->nullable();
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
            $table->dropColumn('matchEnd_time');
        });
    }
}
