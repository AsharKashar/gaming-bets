<?php


namespace App\Service;

use App\Model\MatchUser;
use App\Model\Tournament;
use App\Model\TournamentPrize;
use App\Model\UserPointsHistory;

class CommonFiveVsFiveService
{
    public static float $decay = 0.3;
    public static float $minDecay = 0.99;
    protected static array $availableBands = [
        '2.5' => [
            '80' => [75,145],
            '160' => [150,295],
            '320' => [300,590],
            '640' => [595,1185],
            '1280' => [1190,2370],
            '2560' => [2375,4740],
            '5120' => [4745,9475],
            '10240' => [9480,null],
        ],
        '5' => [
            '80' => [75,145],
            '160' => [150,295],
            '320' => [300,595],
            '640' => [600,1190],
            '1280' => [1195,2385],
            '2560' => [2390,4765],
            '5120' => [4770,9530],
            '10240' => [9535,null],
        ],
        '7.5' => [
            '80' => [80,145],
            '160' => [150,295],
            '320' => [300,595],
            '640' => [600,1195],
            '1280' => [1200,2390],
            '2560' => [2395,4780],
            '5120' => [4785,9555],
            '10240' => [9560,null],
        ],
        '10' => [
            '80' => [80,150],
            '160' => [155,300],
            '320' => [305,600],
            '640' => [605,1195],
            '1280' => [1200,2395],
            '2560' => [2400,4790],
            '5120' => [4795,9575],
            '10240' => [9580,null],
        ],
        '15' => [
            '80' => [80,150],
            '160' => [155,300],
            '320' => [305,600],
            '640' => [605,1200],
            '1280' => [1205,2400],
            '2560' => [2405,4800],
            '5120' => [4805,9600],
            '10240' => [9605,null],
        ],
        '20' => [
            '80' => [80,150],
            '160' => [155,300],
            '320' => [305,600],
            '640' => [605,1200],
            '1280' => [1205,2405],
            '2560' => [2410,4810],
            '5120' => [4815,9615],
            '10240' => [9620,null],
        ],
        '25' => [
            '80' => [80,150],
            '160' => [155,300],
            '320' => [305,600],
            '640' => [605,1205],
            '1280' => [1210,2410],
            '2560' => [2415,4815],
            '5120' => [4820,9625],
            '10240' => [9630,null],
        ],
    ];
    protected static array $pointsParts =  [
        'participation' => 200,
        'winedMatch' => 500
    ];

    //TODO::Replace hardcoded values to calculations
    protected static array $prizeDistributionNumbersOfTeam = [
        '2.5' => [
            '16' => 5,
            '32' => 9,
            '64' => 18,
            '128' => 35,
            '256' => 67,
            '512' => 128,
            '1024' => 246,
            '2048' => 471,
        ],
        '5' => [
            '16' => 4,
            '32' => 7,
            '64' => 13,
            '128' => 26,
            '256' => 49,
            '512' => 92,
            '1024' => 174,
            '2048' => 328,
        ],
        '7.5' => [
            '16' => 3,
            '32' => 6,
            '64' => 11,
            '128' => 21,
            '256' => 40,
            '512' => 74,
            '1024' => 138,
            '2048' => 256,
        ],
        '10' => [
            '16' => 3,
            '32' => 5,
            '64' => 10,
            '128' => 18,
            '256' => 34,
            '512' => 62,
            '1024' => 114,
            '2048' => 208,
        ],
        '15' => [
            '16' => 2,
            '32' => 4,
            '64' => 7,
            '128' => 14,
            '256' => 25,
            '512' => 44,
            '1024' => 79,
            '2048' => 137,
        ],
        '20' => [
            '16' => 2,
            '32' => 3,
            '64' => 6,
            '128' => 11,
            '256' => 19,
            '512' => 32,
            '1024' => 55,
            '2048' => 89,
        ],
        '25' => [
            '16' => 2,
            '32' => 3,
            '64' => 5,
            '128' => 8,
            '256' => 14,
            '512' => 23,
            '1024' => 37,
            '2048' => 53,
        ],
    ];
    protected static array $topOnePrizeDist = [
        '2.5' => [
            '16' => 0.5133,
            '32' => 0.4883,
            '64' => 0.4633,
            '128' => 0.4383,
            '256' => 0.4133,
            '512' => 0.3833,
            '1024' => 0.3633,
            '2048' => 0.3383,
        ],
        '5' => [
            '16' => 0.5633,
            '32' => 0.5383,
            '64' => 0.5133,
            '128' => 0.4883,
            '256' => 0.4633,
            '512' => 0.4383,
            '1024' => 0.4133,
            '2048' => 0.3883,
        ],
        '7.5' => [
            '16' => 0.5967,
            '32' => 0.5717,
            '64' => 0.5467,
            '128' => 0.5217,
            '256' => 0.4967,
            '512' => 0.4717,
            '1024' => 0.4467,
            '2048' => 0.4217,
        ],
        '10' => [
            '16' => 0.6217,
            '32' => 0.5967,
            '64' => 0.5717,
            '128' => 0.5467,
            '256' => 0.5217,
            '512' => 0.4967,
            '1024' => 0.4717,
            '2048' => 0.4467,
        ],
        '15' => [
            '16' => 0.6550,
            '32' => 0.6300,
            '64' => 0.6050,
            '128' => 0.5800,
            '256' => 0.5550,
            '512' => 0.5300,
            '1024' => 0.5050,
            '2048' => 0.4800,
        ],
        '20' => [
            '16' => 0.6800,
            '32' => 0.6550,
            '64' => 0.6300,
            '128' => 0.6050,
            '256' => 0.5800,
            '512' => 0.5550,
            '1024' => 0.5300,
            '2048' => 0.5050,
        ],
        '25' => [
            '16' => 0.70,
            '32' => 0.68,
            '64' => 0.65,
            '128' => 0.63,
            '256' => 0.6,
            '512' => 0.58,
            '1024' => 0.55,
            '2048' => 0.53,
        ],
    ];
    protected static array $proposedPrizeMoney = [
        '2.5' => [
            '16' => 80,
            '32' => 159,
            '64' => 316,
            '128' => 628,
            '256' => 1248,
            '512' => 2480,
            '1024' => 4928,
            '2048' => 9792,
        ],
        '5' => [
            '16' => 168,
            '32' => 334,
            '64' => 664,
            '128' => 1320,
            '256' => 2624,
            '512' => 5216,
            '1024' => 10368,
            '2048' => 20608,
        ],
        '7.5' => [
            '16' => 258,
            '32' => 513,
            '64' => 1020,
            '128' => 2028,
            '256' => 4032,
            '512' => 8016,
            '1024' => 15936,
            '2048' => 31680,
        ],
        '10' => [
            '16' => 349,
            '32' => 695,
            '64' => 1381,
            '128' => 2747,
            '256' => 5461,
            '512' => 10859,
            '1024' => 21589,
            '2048' => 42923,
        ],
        '15' => [
            '16' => 536,
            '32' => 1066,
            '64' => 2120,
            '128' => 4216,
            '256' => 8384,
            '512' => 16672,
            '1024' => 33152,
            '2048' => 65920,
        ],
        '20' => [
            '16' => 725,
            '32' => 1443,
            '64' => 2869,
            '128' => 5707,
            '256' => 11349,
            '512' => 22571,
            '1024' => 44885,
            '2048' => 89259,
        ],
        '25' => [
            '16' => 917,
            '32' => 1823,
            '64' => 3627,
            '128' => 7213,
            '256' => 14347,
            '512' => 28533,
            '1024' => 56747,
            '2048' => 112853,
        ],
    ];

    public static function getPrizes($winnersCount, $topOnePrizeDist, $prizePool)
    {
        $prizes = [];
        $topOnePrize = $prizePool * $topOnePrizeDist;
        $counter = 0;

        for ($decayOfDecay=0.01; $decayOfDecay<=1; $decayOfDecay+=0.0001){
            $sum = $topOnePrize;
            $resultPrizes = [];
            array_push($resultPrizes,round($topOnePrize, 2));

            for ($i=2; $i<=$winnersCount; $i++) {
                $counter++;
                $rule = self::$decay * pow((1 + $decayOfDecay) , ($i-1));
                $prize = $resultPrizes[$i-2] * self::$minDecay;

                if ($rule <= self::$minDecay) {
                    $prize = $resultPrizes[$i-2] * $rule;
                }

                $sum+=$prize;
                array_push($resultPrizes, round($prize, 2));
            }

            if ($sum >= $prizePool) {
                $prizes = $resultPrizes;
                break;
            }
        }
        return $prizes;
    }

    public static function createTournamentPrizes(Tournament $tournament) {
        $entryFee = $tournament->entry_fee;
        $teamsCount = $tournament->tournament_size['players_count'] / 5;

        $winnersCount = self::$prizeDistributionNumbersOfTeam[(string)$entryFee][(string)$teamsCount];
        $topOnePrizeDist = self::$topOnePrizeDist[(string)$entryFee][(string)$teamsCount];
        $prizePool = self::$proposedPrizeMoney[(string)$entryFee][(string)$teamsCount];

        $prizes = self::getPrizes($winnersCount, $topOnePrizeDist, $prizePool);

        TournamentPrize::where('tournament_id',$tournament->id)->delete();

        foreach ($prizes as $key => $prize) {
            TournamentPrize::create([
                'tournament_id' => $tournament->id,
                'position' => $key + 1,
                'prize' => $prize,
                'point' => 0
            ]);
        }
    }

    public static function createDummyPrizes(Tournament $tournament) {
        $prizes = self::getPrizes(5, 0.5133, 80);

        TournamentPrize::where('tournament_id',$tournament->id)->delete();

        foreach ($prizes as $key => $prize) {
            TournamentPrize::create([
                'tournament_id' => $tournament->id,
                'position' => $key + 1,
                'prize' => $prize,
                'point' => 0
            ]);
        }
    }

    public static function getTournamentLimits($fee, $tournamentSize) {
        return self::$availableBands[(string)$fee][(string)$tournamentSize];
    }

    public static function getTournamentSizeByPlayersCount($fee, $playersCount) {
        $sizes = array_reverse(self::$availableBands[(string)$fee],true);

        foreach ($sizes as $size => $limits) {
            if ($playersCount >= $limits[0]) {
                return [
                    'players_count' => $size,
                    'limits' => $limits
                ];
            }
        }

        return null;
    }

    public static function setUsersPointsForMatch($match) {
        if(($teams = $match->teams)->count() <= 0) {
            return false;
        }

        foreach ($teams as $team) {
            $members = $team->members;
            $winnerTeamId = $match->winnerTeam()->team_id;
            $teamIsWinner = $team->team_id === $winnerTeamId;

            foreach ($members as $member) {

                $matchUser = MatchUser::where('match_id',$match->match_id)
                    ->where('user_id',$member->id)
                    ->where('team_id',$team->team_id)
                    ->first();

                if(!$matchUser || !$matchUserId = $matchUser->id){
                    continue;
                }

                UserPointsHistory::create([
                    'match_user_id' => $matchUserId,
                    'points' => self::$pointsParts['participation'],
                    'reason' => UserPointsHistory::$REASONS['participation']
                ]);

                if ($teamIsWinner) {
                    UserPointsHistory::create([
                        'match_user_id' => $matchUserId,
                        'points' => self::$pointsParts['winedMatch'],
                        'reason' => UserPointsHistory::$REASONS['winedMatch']
                    ]);
                }
            }
        }
    }
}
