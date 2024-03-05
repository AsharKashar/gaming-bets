<?php

namespace App\Observers;

use App\Model\BombHistory;
use App\Model\TeamTournament;
use App\Model\TeamTournamentUser;
use App\Relations\TeamUserRelation;
use App\Service\BombsPayment;

class TeamUserRelationObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param TeamUserRelation $member
     * @return void
     */

    public function created(TeamUserRelation $member) {
        $teamTournaments = TeamTournament::where('team_id', $member->team_id);

        if ($teamTournaments) {
            $teamTournaments->get()->each(function ($teamTournament) use ($member){
                TeamTournamentUser::create([
                    'team_tournament_id' => $teamTournament->id,
                    'user_id' => $member->user->id,
                ]);
            });
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param TeamUserRelation $member
     * @return void
     */
    public function deleted(TeamUserRelation $member)
    {
        $teamTournaments = TeamTournament::where('team_id', $member->team_id);
        if ($teamTournaments) {
            $teamTournaments->get()->each(function ($teamTournament) use ($member){
                $teamTournamentUser = $teamTournament->tournamentUsers->firstWhere('user_id', $member->user->id);
                if ($teamTournamentUser) {

                    if ($teamTournamentUser->bomb_payed === 1) {
                        $type = BombHistory::TYPES['tournament'];
                        if (BombsPayment::returnUserBomb($member->user_id, $type, [$type => $teamTournament->tournament_id])) {
                            $teamTournamentUser->delete();
                        }
                    } else {
                        $teamTournamentUser->delete();
                    }

                    $teamTournament->update([
                        'is_valid' => 0
                    ]);
                }

            });
        }
    }
}
