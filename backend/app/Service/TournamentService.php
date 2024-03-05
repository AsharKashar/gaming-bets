<?php

namespace App\Service;

use App\Jobs\FinishTournament;
use App\Jobs\RegistrationFinishTournament;
use App\Jobs\RegistrationStartTournament;
use App\Jobs\StartTournament;
use App\Jobs\TournamentStartNotification;
use App\Model\BombHistory;
use App\Model\GlobalOptions;
use App\Model\Match;
use App\Model\MatchTeam;
use App\Model\MatchUser;
use App\Model\Status;
use App\Model\Team;
use App\Model\Tournament;
use App\Model\User;
use App\Model\UserNotification;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Mockery\Exception;

class TournamentService
{
    /**
     * @param  Tournament  $tournament
     */
    public static function notifyOnStatusChange(Tournament $tournament)
    {
        $statusType = $tournament->status->type;
        $group = Status::GROUPS['tournament'];
        $playersIds = $tournament->players()->pluck('id')->toArray();

        switch ($tournament->status->type) {
            case Status::TOURNAMENT_TYPES['started'] :
            {
                foreach ($playersIds as $playerId) {
                    NotificationsService::tournamentStatusChange($group.'_'.$statusType, $tournament, $playerId);
                }
                break;
            }
            default:
                break;
        }
    }

    /**
     * @param  Tournament  $tournament
     */
    public static function createTournamentPrizes(Tournament $tournament)
    {
        switch ($tournament->teamSize->size) {
            case 5:
                CommonFiveVsFiveService::createTournamentPrizes($tournament);
                break;
            default:
                //CommonFiveVsFiveService::createDummyPrizes($tournament);
                break;
        }
    }

    /**
     * @param  Tournament  $tournament
     * @return mixed|null
     */
    public static function validateTournamentSize(Tournament $tournament)
    {
        $minRequiredSize = $tournament->tournamentSize["players_min_count"];
        $actualSize = $tournament->tournamentSize["players_actual_count"];
        $entryFee = $tournament->entryFee;
        $game = $tournament->game;
        $teamSize = $tournament->teamSize->size;

        if ($actualSize < $minRequiredSize) {
            $tournamentSize = null;

            switch ($game->tag) {
                case 'fortnite':
                    //TODO::implement getTournamentSizeByPlayersCount for Fortnite;
                    break;
                default:
                    if ($teamSize === 5) {
                        $tournamentSize = CommonFiveVsFiveService::getTournamentSizeByPlayersCount($entryFee,
                            $actualSize);
                    }
                    break;
            }


            if ($tournamentSize) {
                $requiredSize = $game->tournamentSizes()->where('players_count',
                    $tournamentSize['players_count'])->first();
                return $requiredSize->id; // downgrade
            } else {
                return null; // cancel tournament
            }
        }

        return $tournament->tournament_size_id; // no downgrade/upgrade
    }

    /**
     * @param  Tournament  $tournament
     * @return bool
     */
    public static function refundTeamsIfNecessary(Tournament $tournament)
    {
        $refundTeamsCount = $tournament->tournamentSize['teams_actual_count'] - $tournament->tournamentSize['teams_count'];
        if ($refundTeamsCount > 0) {
            $refundTeamTournamentIds = $tournament->teams()
                ->orderBy('team_tournament.id', 'desc')
                ->limit($refundTeamsCount)
                ->pluck('id')
                ->toArray();
            TournamentTeamsService::returnTeamTournamentByIds($refundTeamTournamentIds,
                UserNotification::$NOTIFICATION_REASON['bombs_refund']);
            return true;
        }

        return false;
    }

    /**
     * @param  Tournament  $tournament
     */
    public static function cancelTournament(Tournament $tournament)
    {
        $refundTeamTournamentIds = $tournament->teams()
            ->pluck('id')
            ->toArray();
        TournamentTeamsService::returnTeamTournamentByIds($refundTeamTournamentIds,
            UserNotification::$NOTIFICATION_REASON['cancel_tournament']);
        self::updateStatusTournament($tournament, Status::TOURNAMENT_TYPES['canceled']);
    }

    private static function notifyBeforeTournamentStartJob(Tournament $tournament)
    {
        $notificationDelay = self::getTournamentDelays($tournament)['start_notification'];
        $job = new TournamentStartNotification($tournament->id);

        if ($notificationDelay > 0) {
            $job = $job->delay(Carbon::now()->addSeconds($notificationDelay))->onQueue('bangergames');
        } else {
            $job = $job->onQueue('bangergames');
        }

        dispatch($job);
    }

    private static function regStartTournamentJob(Tournament $tournament)
    {
        $tournamentRegStartDelay = self::getTournamentDelays($tournament)['reg_start'];
        $job = (new RegistrationStartTournament($tournament->id))->delay($tournamentRegStartDelay)->onQueue('bangergames');

        dispatch($job);
    }

    private static function regFinishTournamentJob(Tournament $tournament)
    {
        $tournamentRegistrationFinishDelay = self::getTournamentDelays($tournament)['reg_end'];
        $job = (new RegistrationFinishTournament($tournament->id))->delay($tournamentRegistrationFinishDelay)->onQueue('bangergames');
        dispatch($job);
    }

    private static function startTournamentJob(Tournament $tournament)
    {
        $tournamentStartDelay = self::getTournamentDelays($tournament)['start'];
        $job = (new StartTournament($tournament->id))->delay($tournamentStartDelay)->onQueue('bangergames');
        dispatch($job);
    }

    public static function finishTournamentJob(Tournament $tournament)
    {
        $tournamentFinishDelay = self::getTournamentDelays($tournament)['ended'];
        $job = (new FinishTournament($tournament->id))->delay($tournamentFinishDelay)->onQueue('bangergames');
        dispatch($job);
    }

    public static function createTournamentJobs(Tournament $tournament)
    {
        self::notifyBeforeTournamentStartJob($tournament);
        self::regStartTournamentJob($tournament);
        self::regFinishTournamentJob($tournament);
        self::startTournamentJob($tournament);
        self::finishTournamentJob($tournament);
    }

    public static function getTournamentDelays($tournament)
    {
        $notificationTimeShift = 15 * 60;
        $tournamentRegStartAtDelay = $tournament->reg_start_at->diffInSeconds(Carbon::now());
        $tournamentRegEndAtDelay = $tournament->reg_end_at->diffInSeconds(Carbon::now());
        $tournamentStartAtDelay = $tournament->start_at->diffInSeconds(Carbon::now());
        $tournamentEndAtDelay = $tournament->end_at->diffInSeconds(Carbon::now());
        $notificationBeforeTournamentDelay = $tournament->start_at->diffInSeconds(Carbon::now()) - $notificationTimeShift;

        return [
            'start_notification' => $notificationBeforeTournamentDelay,
            'reg_start' => $tournamentRegStartAtDelay,
            'reg_end' => $tournamentRegEndAtDelay,
            'start' => $tournamentStartAtDelay,
            'ended' => $tournamentEndAtDelay,
        ];
    }

    public static function updateStatusTournament(Tournament $tournament, string $status)
    {
        $tournament->update([
            'status_id' => Status::getIdByTournamentType($status)
        ]);
    }

    public static function rewardTournamentWinners(Tournament $tournament)
    {
        $winnersIds = self::getWinnersIds($tournament);
        self::setTournamentWinners($tournament, $winnersIds);
    }

    public static function getWinnersIds(Tournament $tournament)
    {
        $winnersCount = $tournament->prizes->count();
        $matches = $tournament->matches()->orderBy('round', 'desc');
        $rounds = array_reverse($tournament->matches()->groupBy('round')->pluck('round')->toArray());
        $winners = [$matches->first()->winnerTeam()->team_id];

        foreach ($rounds as $round) {
            if (count($winners) === $winnersCount) {
                return $winners;
            }

            $roundMatches = $tournament->matches()->orderBy('round', 'desc')->where('round', $round)->get();

            foreach ($roundMatches as $roundMatch) {
                if (count($winners) === $winnersCount) {
                    return $winners;
                }

                $winner = $roundMatch->winnerTeam()->team_id;

                if (!in_array($winner, $winners)) {
                    array_push($winners, $winner);
                }
            }
        }


        return $winners;
    }

    /**
     * @param  Tournament  $tournament
     * @param  array  $orderedWinnersIds
     * @return bool
     */
    public static function setTournamentWinners(Tournament $tournament, array $orderedWinnersIds)
    {
        $orderedWinnersIds = array_unique($orderedWinnersIds);
        $requiredWinnersCount = $tournament->prizes->count();
        $orderedWinnersIdsCount = count($orderedWinnersIds);

        if ($orderedWinnersIdsCount !== $requiredWinnersCount) {
            return false;
        }

        foreach ($tournament->prizes as $key => $tournamentPrize) {
            if ($tournamentPrize->team_id) {
                continue;
            }

            $data = [
                'tournament_id' => $tournament->id,
                'tournament_prize_id' => $tournamentPrize->id
            ];

            if (self::rewardTeam($orderedWinnersIds[$key], $tournamentPrize->prize, $data)) {
                $tournamentPrize->team_id = $orderedWinnersIds[$key];
                $tournamentPrize->save();
            }
        }

        return true;
    }

    /**
     * @param $teamId
     * @param $reward
     * @param $data
     * @return bool
     */
    private static function rewardTeam($teamId, $reward, $data)
    {
        try {
            $team = Team::find($teamId);
            $members = $team->members;
            $memberReward = $reward / count($members);

            foreach ($members as $member) {
                BombHistory::create([
                    'user_id' => $member->id,
                    'bombs_paid' => 0,
                    'bombs_reward' => $memberReward,
                    'bombs_free' => 0,
                    'type' => BombHistory::TYPES['winnerReward'],
                    'pay' => $data,
                ]);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    //FOR DEVELOPMENT TESTS ONLY
    public static function createDemoMatches(Tournament $tournament, $teamsCount)
    {
        self::seedDemoTeamsToTournament($tournament, $teamsCount);

        $teams = $tournament->teams;
        $rounds = $teams->count() / 2;
        $winnersIds = $teams->pluck('team_id')->toArray();

        for ($round = 1; $round <= $rounds; $round++) {
            shuffle($winnersIds);
            $newWinners = [];

            for ($match = 1; $match <= count($winnersIds) / 2; $match++) {
                $toTeam = ($match * 2) - 1;
                $teamIds = [$winnersIds[$toTeam], $winnersIds[$toTeam - 1]];

                if (!$winnersIds[$toTeam] || !$winnersIds[$toTeam - 1]) {
                    continue;
                }

                $hostedBy = optional(Team::find($teamIds[0])->members[0])->id ?? null;

                $matchItem = Match::create([
                    'title' => "Match_".$round.$match,
                    'hosted_by' => $hostedBy,
                    'tournament_id' => $tournament->id,
                    'round' => $round,
                    'status_id' => Status::getIdByMatchType(Status::MATCH_TYPES['ended'])
                ]);


                foreach ($teamIds as $key => $teamId) {
                    $team = Team::find($teamId);
                    $members = $team->members;

                    MatchTeam::create([
                        'match_id' => $matchItem->match_id,
                        'team_id' => $teamId,
                        'place' => $key
                    ]);

                    if ($key > 0) {
                        $newWinners[] = $teamId;
                    }


                    foreach ($members as $member) {
                        MatchUser::create([
                            'match_id' => $matchItem->match_id,
                            'team_id' => $teamId,
                            'user_id' => $member->id,
                            'points' => $key > 0 ? 100 : 0
                        ]);
                    }
                }
            }

            $winnersIds = $newWinners;
        }
    }

    //FOR DEVELOPMENT TESTS ONLY
    public static function seedDemoTeamsToTournament(Tournament $tournament, $teamsCount)
    {
        $teams = 0;
        $users = 0;
        for ($i = 0; $i < $teamsCount; $i++) {
            $team = factory(Team::class)->create([
                'team_size_id' => $tournament->gameType->teamSize->id,
                'avatar_key' => 'teams/128/2020/9/c56a2ae28847b9223ea64c7e9a607cca-1600212304.png',
                'game_id' => $tournament->game->id
            ]);
            $teams++;

            for ($u = 0; $u < $team->sizes->size; $u++) {
                try{
                    $user = factory(User::class)->create();
                } catch (QueryException $queryException) { // if duplicate entry
                    $user = factory(User::class)->create();
                }
                BombHistory::create([
                    'user_id' => $user->id,
                    'bombs_paid' => 20,
                    'bombs_reward' => 0,
                    'bombs_free' => 0,
                    'type' => BombHistory::TYPES['tournament'],
                    'pay' => [
                        'tournament_id' => $tournament->id
                    ],
                ]);
                if (0 === $u) {
                    $team->owner_id = $user->id;
                    $team->save();
                }
                $team->addMember($user, ['isLeader' => false, 'checked_in' => true]);
                TournamentTeamsService::joinTeam($team, $tournament, $user);
                $users++;
            }
        }
        return [$teams, $users];
    }

    public static function getTournamentLinks(Tournament $tournament)
    {
        $options = $tournament->options()->where('type', 'links')->pluck('data')->toArray();

        $options = call_user_func_array('array_merge', $options);

        foreach (array_keys(GlobalOptions::TYPE['links']) as $type) {

            if (empty($options[$type])) {
                $options[$type] = optional(GlobalOptions::firstWhere('type', $type))->fields ?? [];
            }
        }
        return $options;
    }
}
