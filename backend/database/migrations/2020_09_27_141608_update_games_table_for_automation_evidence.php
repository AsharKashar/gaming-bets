<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGamesTableForAutomationEvidence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('games', function (Blueprint $table) {
//            $table->boolean('automationEnabled')->default(false);
//            $table->boolean('evidenceUploadEnabled')->default(true);
//            $table->string('automationProvider')->nullable();
//        });
//
//        \App\Model\Game::firstWhere('tag', 'csgo')->update([
//            'automationProvider' => 'dathost'
//        ]);
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
