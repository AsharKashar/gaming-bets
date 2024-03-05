<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditOptionsTournamentTableAndAddColumnGlobalOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournament_options', function (Blueprint $table) {
            $table->dropColumn('join_links');
            $table->dropColumn('support_links');

            $types = array_values(\App\Model\GlobalOptions::TYPE['links']);
            $types[] = 'rules';

            $table->json('data')->after('tournament_id')->nullable();
            $table->enum('type', $types)->after('tournament_id');
            $table->bigInteger('locale_id')->after('tournament_id')->unsigned();

            $table->foreign('locale_id')->references('id')->on('locales');
        });

        Schema::table('global_options', function (Blueprint $table) {
            $table->string('group')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournament_options', function (Blueprint $table) {
            $table->json('join_links')->after('tournament_id');
            $table->json('support_links')->after('tournament_id');

            $table->dropForeign(['locale_id']);

            $table->dropColumn('data');
            $table->dropColumn('type');
            $table->dropColumn('locale_id');
        });

        Schema::table('global_options', function (Blueprint $table) {
            $table->dropColumn('group');
        });
    }
}
