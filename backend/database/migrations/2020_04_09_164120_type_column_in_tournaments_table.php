<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeColumnInTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->enum("type",['user','team']);
            $table->string('check_in')->nullable();
            $table->string('kickoff_in')->nullable();
            $table->integer('top_players')->nullable();
            $table->integer('per_match')->nullable();
            $table->integer('rounds_finished')->default(0);
            $table->timestamp('started_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn(['type','check_in','kickoff_in','top_players','per_match','started_at','rounds_finished']);
        });
    }




}
