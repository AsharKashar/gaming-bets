<?php

namespace App\Observers;

use App\Model\Status;
use App\Model\TeamTournament;
use App\Model\Tournament;
use App\Service\TournamentTeamsService;

class TeamTournamentObserver
{
    /**
     * Handle the tournament "updated" event.
     *
     * @param TeamTournament  $teamTournament
     * @return void
     */
    public function updated(TeamTournament $teamTournament)
    {
        $tournament = Tournament::find($teamTournament->tournament_id);
        if ($tournament->tournament_size['players_actual_count'] >= $tournament->tournament_size['players_count']) {
            $tournament->update([
                'status_id' => Status::getIdByTournamentType(Status::TOURNAMENT_TYPES['full'])
            ]);
            TournamentTeamsService::returnInvalidTeamTournament($tournament->id);
        }
    }
}
