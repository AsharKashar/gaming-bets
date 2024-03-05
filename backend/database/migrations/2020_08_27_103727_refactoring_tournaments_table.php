<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactoringTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('type_id');
            $table->dropColumn('bracket_type_id');
            $table->dropColumn('bracket_size_id');
            $table->dropColumn('team_size_id');


            $table->string('new_image')->after('description');
            $table->string('new_hosted_by')->after('overview');
            $table->bigInteger('new_game_type_id')->unsigned()->after('game_id');
            $table->integer('new_check_in')->after('entry_fee');
            $table->integer('new_kickoff_in')->after('new_check_in');
            $table->integer('new_featured')->after('new_game_type_id')->nullable();
            $table->integer('new_max_team')->after('new_featured')->default(0);
        });

        DB::table('tournaments')->update([
            'new_image' => DB::raw('image'),
            'new_hosted_by' => DB::raw('hosted_by'),
            'new_game_type_id' => DB::raw('game_type_id'),
            'new_check_in' => DB::raw('check_in'),
            'new_kickoff_in' => DB::raw('kickoff_in'),
            'new_featured' => DB::raw('featured'),
            'new_max_team' => DB::raw('max_team'),
        ]);

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('hosted_by');
            $table->dropColumn('game_type_id');
            $table->dropColumn('check_in');
            $table->dropColumn('kickoff_in');
            $table->dropColumn('featured');
            $table->dropColumn('max_team');
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->renameColumn('new_image', 'image');
            $table->renameColumn('new_hosted_by', 'hosted_by');
            $table->renameColumn('new_game_type_id', 'game_type_id');
            $table->renameColumn('new_check_in', 'check_in');
            $table->renameColumn('new_kickoff_in', 'kickoff_in');
            $table->renameColumn('new_featured', 'featured');
            $table->renameColumn('new_max_team', 'max_team');
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->foreign('game_type_id')->references('id')->on('game_types')->cascadeOnDelete();
        });
    }
}
