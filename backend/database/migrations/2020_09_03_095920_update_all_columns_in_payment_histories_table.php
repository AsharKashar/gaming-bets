<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAllColumnsInPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->dropForeign(['tournament_id']);

            $table->dropColumn('bomb');
            $table->dropColumn('tournament_id');
            $table->dropColumn('withdrawal');


            $table->json('response_pay')->after('pay')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->bigInteger('tournament_id')->after('tournament_id');
            $table->decimal('bomb')->after('tournament_id')->default(0);
            $table->boolean('withdrawal')->after('tournament_id')->default(false);
        });
    }
}
