<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEvidenceStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evidence', function (Blueprint $table) {
            $table->dropColumn(['video','image']);
            $table->json('data')->nullable()->after('match_team_id');
            $table->unique(['match_team_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evidence', function (Blueprint $table) {
            $table->dropUnique(['match_team_id']);
            $table->dropColumn(['data']);
            $table->string('video')->nullable()->after('match_team_id');
            $table->string('image')->nullable()->after('video');
        });
    }
}
