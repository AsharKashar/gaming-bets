<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentResultsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('tournament_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("tournament_id");
            $table->bigInteger("first_place");
            $table->bigInteger("second_place");
            $table->bigInteger("third_place");
//            $table->boolean('rematch')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('tournament_results');
    }


}
