<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentSizeLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_size_limits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_size_id');
            $table->unsignedBigInteger('entry_fee_id');
            $table->unsignedBigInteger('teams_min_count')->nullable();
            $table->unsignedBigInteger('teams_max_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament_size_limits');
    }
}
