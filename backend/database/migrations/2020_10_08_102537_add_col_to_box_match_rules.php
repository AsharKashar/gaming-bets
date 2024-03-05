<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToBoxMatchRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('box_match_rules', function (Blueprint $table) {
            //
            $table->string('title')->after('game_id');
        });

        Schema::table('box_match_rules', function (Blueprint $table) {
            //
            $table->dropColumn('rule');
        });

        Schema::table('box_match_rules', function (Blueprint $table) {
            //
            $table->longText('rule')->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('box_match_rules', function (Blueprint $table) {
            //
            $table->dropColumn('title');
            $table->dropColumn('rule');
        });
    }
}
