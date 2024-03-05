<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxmatchUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxmatch_users', function (Blueprint $table) {
            $table->id();
            $table->integer('match_id');
            $table->integer('user_id');
            $table->string('username');
            $table->integer('is_host')->nullable();
            $table->integer('team_id');
            $table->string('result')->nullable();
            $table->text('proof_image')->nullable();
            $table->text('proof_video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxmatch_users');
    }
}
