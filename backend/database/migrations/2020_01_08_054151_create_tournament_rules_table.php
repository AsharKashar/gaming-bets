<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->mediumText("description")->nullable();
            $table->unsignedBigInteger("tournament_id");
            $table->timestamps();

//            $table->foreign("tournament_id")->references("id")->on("tournaments")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament_rules');
    }
}
