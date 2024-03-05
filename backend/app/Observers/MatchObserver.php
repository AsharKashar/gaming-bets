<?php

namespace App\Observers;

use App\Jobs\MatchEndJob;
use App\Jobs\MatchPendingResultsJob;
use App\Model\Match;
use App\Model\Status;
use App\Model\Team;
use App\Model\User;
use App\Service\BracketService;
use App\Service\MatchService;
use App\Service\NotificationsService;
use App\Service\PointsService;
use Carbon\Carbon;

class MatchObserver
{
    private MatchService $matchService;

    /**
     * MatchObserver constructor.
     * @param  MatchService  $matchService
     */
    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    /**
     * @param Match $match
     */
    public function updated(Match $match)
    {
        $newStatusId = (int)$match['status_id'];
        $matchStatusWasChanged = $newStatusId !== (int)$match->getOriginal('status_id');

        if ($matchStatusWasChanged) {
            switch($newStatusId) {
                case Status::getIdByMatchType(Status::MATCH_TYPES['ended']): {

                    if (!$match->winnerTeam()) {
                        $match->randomWinner();
                    }

                    PointsService::setUsersPointsForMatch($match);
                    /** @var Team $winnerTeam */
                    $winnerTeam = $match->winnerTeam();
                    if($winnerTeam){
                        foreach ($winnerTeam->members as $member){
                            NotificationsService::matchWin($match, $member->id);
                        }

                        $loosedTeams = $match->teams()->where('teams.team_id','!=',$winnerTeam->team_id)->get();
                        /** @var Team $loosedTeam */
                        foreach ($loosedTeams as $loosedTeam) {
                            foreach ($loosedTeam->members as $member){
                                NotificationsService::matchLoose($match, $member->id);
                            }
                        }
                    }

                    $bracketService = new BracketService();
                    $bracketService
                        ->setTournament($match->tournament)
                        ->updateMixtureByRoundId($match->round)
                    ;
                    break;
                }
                case Status::getIdByMatchType(Status::MATCH_TYPES['teams_added']): {

                    if ($match->round === 1) {
                        $startAt = Carbon::parse($match->tournament->start_at)->format('Y-m-d H:i:s');
                        $endAtMin = Carbon::parse($match->tournament->start_at)->addMinutes($match->tournament->gameMode->matchLimits->min)->format('Y-m-d H:i:s');
                        $endAtMax = Carbon::parse($match->tournament->start_at)->addMinutes($match->tournament->gameMode->matchLimits->max)->format('Y-m-d H:i:s');
                    } else {
                        $startAt = Carbon::now()->format('Y-m-d H:i:s');
                        $endAtMin = Carbon::now()->addMinutes($match->tournament->gameMode->matchLimits->min)->format('Y-m-d H:i:s');
                        $endAtMax = Carbon::now()->addMinutes($match->tournament->gameMode->matchLimits->max)->format('Y-m-d H:i:s');
                    }
                    $match->update([
                        'start_at' => $startAt,
                        'end_at_min' => $endAtMin,
                        'end_at_max' => $endAtMax,
                    ]);
                    break;
                }
                case Status::getIdByMatchType(Status::MATCH_TYPES['live']): {

                    $job = (new MatchPendingResultsJob($match))
                        ->delay($match->end_at_min)
                        ->onQueue('bangergames')
                    ;
                    dispatch($job);
                    break;
                }
                case Status::getIdByMatchType(Status::MATCH_TYPES['conflict']): {
                    $job = (new MatchEndJob($match))
                        ->delay($match->conflict_end_at)
                        ->onQueue('bangergames');
                    dispatch($job);
                    break;
                }
                default:break;
            }
        }


        if ((int)$match['hosted_by'] !== (int)$match->getOriginal('hosted_by')) {
            if ($match->tournament->game->tag !== 'csgo') {
                foreach($match->teams as $team) {
                    foreach ($team->members as $member) {
                        NotificationsService::hostIsCreatingMatch(User::find($match['hosted_by']), $member);
                    }
                }
            }
        }

        if ($match['start_at'] !== $match->getOriginal('start_at')) {
            (new MatchService())->setMatch($match)->matchWillBeStartedSoon();
        }
    }
}
