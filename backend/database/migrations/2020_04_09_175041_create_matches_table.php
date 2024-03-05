<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('match_id');

            $table->enum('type', ['user', 'team'])->default('user');
            $table->string('title');

            $table->unsignedBigInteger('winner_id')->nullable();
            $table->enum('status', ['upcoming', 'started','ended', 'close'])->default('upcoming');

            $table->unsignedBigInteger('hosted_by')->nullable();
            $table->unsignedBigInteger('tournament_id');

            $table->text('e_image1')->nullable();
            $table->text('e_image2')->nullable();

            $table->text('e_video1')->nullable();
            $table->text('e_video2')->nullable();

            $table->boolean('close_for1')->default(false);
            $table->boolean('close_for2')->default(false);


            $table->integer('round')->nullable();

            $table->bigInteger('parent_1')->nullable();
            $table->bigInteger('parent_2')->nullable();

            $table->bigInteger('team_1')->nullable();
            $table->bigInteger('team_2')->nullable();

            $table->timestamp('start_at');
            $table->boolean('is_final')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('matches');
    }




}
