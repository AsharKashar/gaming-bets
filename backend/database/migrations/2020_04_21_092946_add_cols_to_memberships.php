<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToMemberships extends Migration
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
            $table->string('daily_quantity')->nullable();
            $table->string('daily_date')->nullable();
            $table->string('weekly_quantity')->nullable();
            $table->string('weekly_date')->nullable();
            $table->string('monthly_quantity')->nullable();
            $table->string('monthly_date')->nullable();
            $table->string('membership_quantity')->nullable();
            $table->string('permission')->nullable();
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
            $table->dropColumn('daily_quantity');
            $table->dropColumn('daily_date');
            $table->dropColumn('weekly_quantity');
            $table->dropColumn('weekly_date');
            $table->dropColumn('monthly_quantity');
            $table->dropColumn('monthly_date');
            $table->dropColumn('membership_quantity');
            $table->dropColumn('permission');
        });
    }
}
