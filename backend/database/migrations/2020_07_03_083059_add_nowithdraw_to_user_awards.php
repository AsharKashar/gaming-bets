<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNowithdrawToUserAwards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_awards', function (Blueprint $table) {
            //
            $table->integer('no_withdraw')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_awards', function (Blueprint $table) {
            //
            $table->dropColumn('no_withdraw');
        });
    }
}
