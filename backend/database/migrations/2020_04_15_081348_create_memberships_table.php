<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stripe_id');
            $table->string('user_id');
            $table->string('sub_id')->nullable();;
            $table->string('plan_id')->nullable();
            $table->string('sub_update_date')->nullable();
            $table->string('boxfight_quantity')->nullable();
            $table->string('daily_allowed')->nullable();
            $table->string('weekly_allowed')->nullable();
            $table->string('monthly_allowed')->nullable();
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
        Schema::dropIfExists('memberships');
    }
}
