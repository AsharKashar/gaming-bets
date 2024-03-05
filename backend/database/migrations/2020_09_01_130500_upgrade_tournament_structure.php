<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpgradeTournamentStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            if (Schema::hasColumn('tournaments', 'max_team')) {
                $table->dropColumn('max_team');
            }
            if (Schema::hasColumn('tournaments', 'entry_fee')) {
                $table->dropColumn('entry_fee');
            }

            $table->unsignedBigInteger('entry_fee_id')->nullable()->after('hosted_by');
            $table->unsignedBigInteger('tournament_size_id')->nullable()->after('hosted_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
