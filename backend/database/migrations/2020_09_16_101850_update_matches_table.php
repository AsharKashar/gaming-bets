<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $columnsToDrop = [
            'winner_id',
            'e_image1',
            'e_image2',
            'e_video1',
            'e_video2',
            'close_for1',
            'close_for2',
            'team_1',
            'team_2',
            'result_1',
            'result_2',
            'rewarded',
            'parent_1',
            'parent_2',
            'type'
        ];

        Schema::table('matches', function (Blueprint $table) use($columnsToDrop) {
            foreach ($columnsToDrop as $columnToDrop) {
                if (Schema::hasColumn('matches', $columnToDrop)) {
                    $table->dropColumn($columnToDrop);
                }
            }
            $table->foreign('tournament_id')->references('id')->on('tournaments')->cascadeOnDelete();
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
            $table->dropForeign(['tournament_id']);
        });
    }
}
