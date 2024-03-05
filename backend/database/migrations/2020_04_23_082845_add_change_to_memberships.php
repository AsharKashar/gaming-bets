<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeToMemberships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberships', function (Blueprint $table) {
            //

            $table->dropColumn('daily_date');

            $table->dropColumn('weekly_date');

            $table->dropColumn('monthly_date');

            $table->dropColumn('sub_update_date');
        });

        Schema::table('memberships', function (Blueprint $table) {
            //

            $table->timestamp('daily_date')->nullable();

            $table->timestamp('weekly_date')->nullable();

            $table->timestamp('monthly_date')->nullable();

            $table->timestamp('sub_update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memberships', function (Blueprint $table) {
            //
            $table->dropColumn('daily_date');

            $table->dropColumn('weekly_date');

            $table->dropColumn('monthly_date');

            $table->dropColumn('sub_update_date');
        });
    }
}
