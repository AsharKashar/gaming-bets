<?php


namespace App\Service;


use App\Model\Match;
use App\Model\MatchTeam;
use App\Model\MatchUser;
use App\Model\Status;
use App\Model\Team;
use App\Model\Tournament;

/**
 * Class BracketService
 * @package App\Service
 */
class BracketService
{
    private Tournament $tournament;

    /**
     * @param  Tournament  $tournament
     * @return BracketService
     */
    public function setTournament(Tournament $tournament): BracketService
    {
        $this->tournament = $tournament;
        return $this;
    }

    /**
     * @return $this
     */
    public function validateTournament(): BracketService
    {
        $validatedTournamentSizeId = TournamentService::validateTournamentSize($this->tournament);

        if (null === $validatedTournamentSizeId) {
            TournamentService::cancelTournament($this->tournament);
            return $this;
        }

        if ($validatedTournamentSizeId && $this->tournament->tournament_size_id !== $validatedTournamentSizeId) {
            $this->tournament->update(['tournament_size_id' => $validatedTournamentSizeId]);
        }

        TournamentService::refundTeamsIfNecessary($this->tournament);
        TournamentService::createTournamentPrizes($this->tournament);

        return $this;
    }

    /**
     * @return $this
     */
    public function cleanUpStructure(): BracketService
    {
        $matches = Match::where('tournament_id', $this->tournament->id)->get();
        foreach ($matches as $match) {
            $matchTeams = MatchTeam::where('match_id', $match->id);
            $matchUsers = MatchUser::where('match_id', $match->id);

            $matchUsers->delete();
            $matchTeams->delete();
            $match->delete();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function generateStructure(): BracketService
    {
        $roundCount = $this->getRoundCount();
        $currentMatchId = 0;
        for ($currentRound = 1; $currentRound <= $roundCount; $currentRound++) {
            $matchCountByRound = $this->getMatchCountByRound($currentRound);
            for ($matchInRound = 0; $matchInRound < $matchCountByRound; $matchInRound++) {
                $currentMatchId++;
                Match::create([
                    'title' => 'Match-'.$currentMatchId,
                    'tournament_id' => $this->tournament->id,
                    'round' => $currentRound,
                    'is_final' => (int) ($roundCount === $currentRound),
                    'status_id' => Status::getIdByMatchType(Status::MATCH_TYPES['created'])
                ]);
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function mixtureFirstRound(): BracketService
    {
        $teamIds = array_map(function ($team) {
            return $team['team_id'];
        }, $this->tournament->teams->toArray());
        $this->addRandomTeamsToMatchesByRoundId($teamIds, 1);

        return $this;
    }

    /**
     * @param  int  $round
     * @return $this
     */
    public function updateMixtureByRoundId(int $round): BracketService
    {
        $teamIds = $this->getWinnerTeamIdsByRound($round);
        if (count($teamIds) >= 2 ) {
            $this->addRandomTeamsToMatchesByRoundId($teamIds, $round);
        }

        return $this;
    }

    /**
     * @param  array  $teamIds
     * @param  int  $round
     * @return BracketService
     */
    private function addRandomTeamsToMatchesByRoundId(array $teamIds, int $round): BracketService
    {
        $matches = Match::where('tournament_id', $this->tournament->id)->where('round', $round)->get();
        /** @var Match $match */
        foreach ($matches as $match) {
                $randomKeys = array_rand($teamIds, 2);
                $randomTeamIds = [$teamIds[$randomKeys[0]],$teamIds[$randomKeys[1]]];
                $randomTeams = Team::whereIn('team_id', $randomTeamIds)->get();
                $hostUserId = $randomTeams[0]->owner->id ?? $randomTeams[0]->members[0]->id;

                if ($match->teams()->count() >= 2) {
                    continue; // Pass match if already have teams
                }
                /**
                 * @var int $key
                 * @var Team $randomTeam */
                foreach ($randomTeams as $key => $randomTeam) {
                    MatchTeam::create([
                        'match_id' => $match->match_id,
                        'team_id' => $randomTeam->team_id
                    ]);
                    foreach ($randomTeam->members as $member) {
                        // TODO: notification
                        MatchUser::create([
                            'match_id' => $match->match_id,
                            'team_id' => $randomTeam->team_id,
                            'user_id' => $member->id,
                            'points' => 0
                        ]);
                    }
                    unset($teamIds[array_search($randomTeam->team_id, $teamIds)]);
                }
                $match->update([
                    'hosted_by' => $hostUserId
                ]);
                $matchService = new MatchService();
                $matchService->setMatch($match);
                $matchService->createMatchJobs();
            }

        return $this;
    }

    /**
     * @return float|int
     */
    public function getRoundCount(): int
    {
        return (int) (log($this->tournament->teams->count()) / log(2));
    }

    /**
     * @return int
     */
    public function getFinalRound(): ?int
    {
        /** @var Match $finalMatch */
        $finalMatch = $this->tournament->matches()->orderBy('round', 'desc')->first();

        return $finalMatch ? $finalMatch->round : null;
    }

    /**
     * @return int
     */
    public function getTeamCount(): int
    {
        return $this->tournament->teams->count();
    }

    /**
     * @param  int  $find
     * @return int
     */
    private function getMatchCountByRound(int $find): int
    {
        $teamsCount = $this->getTeamCount();
        $rounds = $this->getRoundCount();
        $matchCount = 0;
        for ($round = 1; $round <= $rounds; $round++) {
            for ($j = 0; $j < $teamsCount; $j += 2) {
                if ($find === $round) {
                    $matchCount++;
                }
            }
            $teamsCount /= 2;
        }

        return $matchCount;
    }

    /**
     * @param  int  $round
     * @return bool
     */
    public function isRoundEnded(int $round): bool
    {
        $matches = $this->tournament->matches()->where('round', $round);
        $matchCount = $matches->count();
        $endedMatchesCount = 0;
        foreach ($matches as $match) {
            if (Status::getIdByMatchType('ended') === Status::find($match->status)->id) {
                $endedMatchesCount++;
            }
        }

        return $matchCount === $endedMatchesCount;
    }


    /**
     * @param  int  $round
     * @return array
     */
    public function getWinnerTeamIdsByRound(int $round): array
    {
        $matches = $this->tournament->matches()->where('round', $round)->get();
        $teamIds = [];
        /** @var Match $match */
        foreach ($matches as $match) {
            if ($winnerTeam = $match->winnerTeam()) {
                $teamIds[] = $winnerTeam->team_id;
            }
        }

        return $teamIds;
    }
}
