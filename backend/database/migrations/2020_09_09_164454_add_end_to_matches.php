<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEndToMatches extends Migration
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
            $table->dateTime('end_at_min')->nullable()->after('start_at');
            $table->dateTime('end_at_max')->nullable()->after('end_at_min');
        });
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
            $table->dropColumn('end_at_min');
            $table->dropColumn('end_at_max');
        });
    }
}
