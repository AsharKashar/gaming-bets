<?php

use App\Model\UserLevel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('user_points', function (Blueprint $table) {
            if (Schema::hasColumn('user_points', 'winning')) {
                $table->dropColumn('winning');
            }

            if (Schema::hasColumn('user_points', 'tournament_id')) {
                $table->dropForeign(['tournament_id']);
                $table->dropColumn('tournament_id');
            }

            $zerolevel = UserLevel::where('points',0)->first()->id;

            $table->unsignedBigInteger('user_level_id')->after('id')->default($zerolevel);
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
