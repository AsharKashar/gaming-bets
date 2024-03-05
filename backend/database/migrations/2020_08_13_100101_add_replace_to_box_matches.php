<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReplaceToBoxMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('box_matches', function (Blueprint $table) {
            //
            $table->dropColumn('proof');
            $table->dropColumn('proof_secondary');
        });

        Schema::table('box_matches', function (Blueprint $table) {
            //
            $table->text('proof_secondary')->after('result');
            $table->text('proof')->after('result');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('box_matches', function (Blueprint $table) {
            //
            $table->dropColumn('proof');
            $table->dropColumn('proof_secondary');
        });
    }
}
