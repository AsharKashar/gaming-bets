<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('game_id');
            $table->unsignedInteger('entry_fee');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamp('reg_start_at')->nullable();
            $table->timestamp('reg_end_at')->nullable();
            $table->text('image')->nullable();
            $table->decimal('first_prize');
            $table->decimal('second_prize');
            $table->decimal('third_prize');
            $table->decimal('first_points');
            $table->decimal('second_points');
            $table->decimal('third_points');
            $table->string('platforms')->nullable();
            $table->string('hosted_by')->nullable();
            $table->enum("status", ['upcoming','check_in', 'started', 'ended'])->default('upcoming');

            $table->string("game_type")->nullable();
            $table->string("game_mode")->nullable();
            $table->string("match_type")->nullable();
            $table->string("match_set")->nullable();

            $table->string('bracket_size')->nullable();
            $table->string('bracket_type')->nullable();
            $table->string('team_size')->nullable();
            $table->string('regions')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('tournament');
    }


}
