<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangesInBoxMatches extends Migration
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
            $table->text('proof_video')->after('result')->nullable();
            $table->text('proof_image')->after('result')->nullable();
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
            $table->dropColumn('proof_image');
            $table->dropColumn('proof_video');
        });
    }
}
