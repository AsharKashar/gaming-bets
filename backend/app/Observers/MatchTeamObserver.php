<?php

namespace App\Observers;
use App\Model\MatchTeam;
use App\Model\Status;
use Carbon\Carbon;


class MatchTeamObserver
{
    /**
     * @param MatchTeam $matchTeam
     */
    public function updating(MatchTeam $matchTeam)
    {
        $notConflictMatch =$matchTeam->match->status_id !== Status::getIdByMatchType(Status::MATCH_TYPES['conflict']);
        $placeAlreadyTaken = $matchTeam->match->itemsMatchTeams()->where('place',$matchTeam['place'])->first();

        if($notConflictMatch && $placeAlreadyTaken) {
            $delay = Carbon::now()->addMinutes(10);
            $matchTeam->match->update([
                'status_id' => Status::getIdByMatchType(Status::MATCH_TYPES['conflict']),
                'conflict_end_at' => $delay
            ]);
            return;
        }
    }

    /**
     * @param MatchTeam $matchTeam
     */
    public function updated(MatchTeam $matchTeam) {
        $matchTeams = $matchTeam->match->itemsMatchTeams();
        $allTeamsHavePlaces = !(clone $matchTeams)->whereNull('place')->first();
        $allPlaces = (clone $matchTeams)->pluck('place')->toArray();
        $containConflicts = count($allPlaces) !== count(array_unique($allPlaces));

        if (!$containConflicts && $allTeamsHavePlaces) {
            $matchTeam->match->update([
                'status_id' => Status::getIdByMatchType(Status::MATCH_TYPES['ended'])
            ]);
            return;
        }
    }
}
