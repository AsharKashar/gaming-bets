<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->bigInteger('account_number')->nullable();
            $table->text('account_holdername')->nullable();
            $table->text('bank_name')->nullable();
            $table->integer('last4')->nullable();
            $table->text('account_holdertype')->nullable();
            $table->text('currency')->nullable();
            $table->bigInteger('routing_number')->nullable();
            $table->text('status')->nullable();
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
        Schema::dropIfExists('withdrawal');
    }
}
