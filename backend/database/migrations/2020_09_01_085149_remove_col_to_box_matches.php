<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColToBoxMatches extends Migration
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
            $table->dropColumn('match_id');
            $table->dropColumn('user_id');
            $table->dropColumn('username');
            $table->dropColumn('team_id');
            $table->dropColumn('result')->nullable();
            $table->dropColumn('proof_image')->nullable();
            $table->dropColumn('proof_video')->nullable();
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
            $table->integer('match_id');
            $table->integer('user_id');
            $table->string('username');
            $table->integer('team_id');
            $table->string('result')->nullable();
            $table->text('proof_image')->nullable();
            $table->text('proof_video')->nullable();
        });
    }
}
