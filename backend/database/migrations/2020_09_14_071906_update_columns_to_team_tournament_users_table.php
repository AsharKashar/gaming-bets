<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\TeamTournamentUser;
use App\Model\User;

class UpdateColumnsToTeamTournamentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('team_tournament_users', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('team_tournament_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        TeamTournamentUser::all()->each(function ($teamTournamentUser) {
            $user = User::firstWhere('email', $teamTournamentUser->email);
            if ($user) {
                $teamTournamentUser->update([
                    'user_id' => $user->id,
                ]);
            } else {
                $teamTournamentUser->delete();
            }
        });

        Schema::table('team_tournament_users', function (Blueprint $table) {
            $table->dropColumn('email');
        });
        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_tournament_users', function (Blueprint $table) {
            $table->string('email')->after('team_tournament_id');
        });

        TeamTournamentUser::all()->each(function ($teamTournamentUser) {
            $teamTournamentUser->update([
                'email' => User::find($teamTournamentUser->user_id)->email,
            ]);
        });

        Schema::table('team_tournament_users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

    }
}
