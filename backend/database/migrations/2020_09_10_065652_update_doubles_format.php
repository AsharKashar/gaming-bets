<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDoublesFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_bombs', function (Blueprint $table) {
            $table->decimal('bombs_free',10,4)->default(0)->change();
            $table->decimal('bombs_reward',10,4)->default(0)->change();
            $table->decimal('bombs_paid',10,4)->default(0)->change();
        });

        Schema::table('tournament_prizes', function (Blueprint $table) {
            $table->decimal('prize',10,4)->default(0)->change();
        });

        Schema::table('bomb_histories', function (Blueprint $table) {
            $table->decimal('bombs_free',10,4)->default(0)->change();
            $table->decimal('bombs_paid',10,4)->default(0)->change();
            $table->decimal('bombs_reward',10,4)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
