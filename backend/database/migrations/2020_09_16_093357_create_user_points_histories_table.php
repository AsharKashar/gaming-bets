<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPointsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();

        Schema::create('user_points_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_user_id');
            $table->integer('points');
            $table->string('reason');
            $table->timestamps();

            $table->foreign('match_user_id')->references('id')->on('match_users')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_points_histories');
    }
}
