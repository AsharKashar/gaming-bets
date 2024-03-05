<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeederToMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            //
            $table->dropColumn('result_1');
            $table->dropColumn('result_2');
        });
        Schema::table('matches', function (Blueprint $table) {
            //
            $table->string('result_1')->nullable();
            $table->string('result_2')->nullable();
        });

            // Artisan::call('db:seed', array('--class' => 'BracketSeederClass'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            //
            $table->dropColumn('result_1');
            $table->dropColumn('result_2');
        });
    }
}
