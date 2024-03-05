<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagsToGameGameModeGameType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('tag')->after('name');
            $table->unique(['tag']);
        });

        Schema::table('game_modes', function (Blueprint $table) {
            $table->string('tag')->after('name');
            $table->unique(['tag']);
        });

        Schema::table('game_types', function (Blueprint $table) {
            $table->string('tag')->after('name');
            $table->unique(['tag']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_modes', function (Blueprint $table) {
            if (Schema::hasColumn('game_modes', 'tag')) {
                $table->dropColumn('tag');
            }
        });

        Schema::table('games', function (Blueprint $table) {
            if (Schema::hasColumn('games', 'tag')) {
                $table->dropColumn('tag');
            }
        });

        Schema::table('game_types', function (Blueprint $table) {
            if (Schema::hasColumn('game_types', 'tag')) {
                $table->dropColumn('tag');
            }
        });
    }
}
