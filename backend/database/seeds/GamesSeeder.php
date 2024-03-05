<?php

use App\Model\Game;
use App\Model\GameMode;
use App\Model\GamePlatform;
use App\Model\GameType;
use App\Model\MatchLimit;
use App\Model\TeamSize;
use App\Model\TournamentSize;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            [
                'name'       => 'Counter Strike: Global Offensive',
                'tag'        => 'csgo',
                'image'      => 'https://cdn.bangergames.com/demo-games/cs-min.jpg',
                'cover'      => 'https://cdn.bangergames.com/demo-games/cs.svg',
                'platforms'  => ['pc'],
                'tournamentSizes' => [80, 160, 320, 640, 1280, 2560, 5120, 10240],
                'gameModes'  => [
                    [
                        'name' => 'Demolition',
                        'tag' => 'demolition',
                        'match_limits' => [
                            'min' => '25',
                            'max' => '110'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 5
                            ]
                        ]
                    ],
                    [
                        'name' => 'Deathmatch',
                        'tag' => 'deathmatch',
                        'match_limits' => [
                            'min' => '15',
                            'max' => '50'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 5
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name'       => 'Fortnite',
                'tag'        => 'fortnite',
                'image'      => 'https://cdn.bangergames.com/demo-games/fortnite-min.jpg',
                'cover'      => 'https://cdn.bangergames.com/demo-games/fortnite.svg',
                'platforms'  => ['xbox','ps','pc','all'],
                'tournamentSizes' => [100, 200, 400, 600, 800, 1000, 1200, 1400, 3000, 5000, 10000],
                'gameModes'  => [
                    [
                        'name' => 'Battleroyale',
                        'tag'  => 'battleroyale',
                        'match_limits' => [
                            'min' => '20',
                            'max' => '35'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ], [
                                'name' => 'Duo',
                                'tag'  => 'duo',
                                'team_size' => 2
                            ], [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 4
                            ]
                        ]
                    ],
                    [
                        'name' => 'Box fight',
                        'tag'  => 'box_fight',
                        'match_limits' => [
                            'min' => '20',
                            'max' => '50'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ], [
                                'name' => 'Duo',
                                'tag'  => 'duo',
                                'team_size' => 2
                            ], [
                                'name' => 'Trio',
                                'tag'  => 'trio',
                                'team_size' => 3
                            ]
                        ]
                    ],
                    [
                        'name' => 'Build fight',
                        'tag'  => 'build fight',
                        'match_limits' => [
                            'min' => '10',
                            'max' => '70'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ]
                        ]
                    ],
                    [
                        'name' => 'Deathrun',
                        'tag'  => 'build_fight',
                        'match_limits' => [
                            'min' => '0',
                            'max' => '0'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ]
                        ]
                    ],
                    [
                        'name' => 'Race',
                        'tag'  => 'race',
                        'match_limits' => [
                            'min' => '0',
                            'max' => '0'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ]
                        ]
                    ],
                    [
                        'name' => 'Arena Mode',
                        'tag'  => 'arena',
                        'match_limits' => [
                            'min' => '0',
                            'max' => '0'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ], [
                                'name' => 'Duo',
                                'tag'  => 'duo',
                                'team_size' => 2
                            ], [
                                'name' => 'Trio',
                                'tag'  => 'trio',
                                'team_size' => 3
                            ], [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 4
                            ]
                        ]
                    ],
                ]
            ],
            [
                'name'       => 'Valorant',
                'tag'        => 'valorant',
                'image'      => 'https://cdn.bangergames.com/demo-games/valorant-min.jpg',
                'cover'      => 'https://cdn.bangergames.com/demo-games/valorant.svg',
                'platforms'  => ['pc'],
                'tournamentSizes' => [80, 160, 320, 640, 1280, 2560, 5120, 10240],
                'gameModes'  => [
                    [
                        'name' => 'Bomb',
                        'tag'  => 'bomb',
                        'match_limits' => [
                            'min' => '30',
                            'max' => '40'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 5
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name'       => 'League of Legends',
                'tag'        => 'lol',
                'image'      => 'https://cdn.bangergames.com/demo-games/ll-min.jpg',
                'cover'      => 'https://cdn.bangergames.com/demo-games/ll.svg',
                'platforms'  => ['pc'],
                'tournamentSizes' => [80, 160, 320, 640, 1280, 2560, 5120, 10240],
                'gameModes'  => [
                    [
                        'name' => 'Summoners Rift',
                        'tag'  => 'summoners_rift',
                        'match_limits' => [
                            'min' => '20',
                            'max' => '40'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 5
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name'       => 'Call of Duty Warzone',
                'tag'        => 'warzone',
                'image'      => 'https://cdn.bangergames.com/demo-games/warzone-min.jpg',
                'cover'      => 'https://cdn.bangergames.com/demo-games/warzone.svg',
                'platforms'  => ['xbox','ps','pc','all'],
                'tournamentSizes' => [80, 160, 320, 640, 1280, 2560, 5120, 10240],
                'gameModes'  => [
                    [
                        'name' => 'Battleroyale',
                        'tag'  => 'battleroyale',
                        'match_limits' => [
                            'min' => '20',
                            'max' => '35'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ], [
                                'name' => 'Duo',
                                'tag'  => 'duo',
                                'team_size' => 2
                            ], [
                                'name' => 'Trio',
                                'tag'  => 'trio',
                                'team_size' => 3
                            ], [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 4
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name'       => 'Call of Duty Modern Warfare',
                'tag'        => 'modern_warfare',
                'image'      => 'https://cdn.bangergames.com/demo-games/warzone-min.jpg',
                'cover'      => 'https://cdn.bangergames.com/demo-games/warzone.svg',
                'platforms'  => ['xbox','ps','pc','all'],
                'tournamentSizes' => [80, 160, 320, 640, 1280, 2560, 5120, 10240],
                'gameModes'  => [
                    [
                        'name' => 'Search & destroy',
                        'tag'  => 'search_destroy',
                        'match_limits' => [
                            'min' => '10',
                            'max' => '45'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 5
                            ]
                        ]
                    ],
                    [
                        'name' => 'Hardpoint',
                        'tag'  => 'hardpoint',
                        'match_limits' => [
                            'min' => '10',
                            'max' => '25'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Squads',
                                'tag'  => 'squads',
                                'team_size' => 5
                            ]
                        ]
                    ],
                    [
                        'name' => 'Gun fight',
                        'tag'  => 'gun_fight',
                        'match_limits' => [
                            'min' => '10',
                            'max' => '20'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ], [
                                'name' => 'Duo',
                                'tag'  => 'duo',
                                'team_size' => 2
                            ], [
                                'name' => 'Trio',
                                'tag'  => 'trio',
                                'team_size' => 3
                            ]
                        ]
                    ],
                    [
                        'name' => 'Death match',
                        'tag'  => 'death_match',
                        'match_limits' => [
                            'min' => '10',
                            'max' => '10'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ], [
                                'name' => 'Duo',
                                'tag'  => 'duo',
                                'team_size' => 2
                            ], [
                                'name' => 'Trio',
                                'tag'  => 'trio',
                                'team_size' => 3
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name'       => 'FIFA20',
                'tag'        => 'fifa',
                'image'      => 'https://cdn.bangergames.com/demo-games/fifa-min.jpg',
                'cover'      => 'https://cdn.bangergames.com/demo-games/fifa.svg',
                'platforms'  => ['xbox','ps'],
                'tournamentSizes' => [80, 160, 320, 640, 1280, 2560, 5120, 10240],
                'gameModes'  => [
                    [
                        'name' => 'Ultimate Team',
                        'tag'  => 'ultimate_team',
                        'match_limits' => [
                            'min' => '12',
                            'max' => '12'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ], [
                                'name' => 'Duo',
                                'tag'  => 'duo',
                                'team_size' => 2
                            ]
                        ]
                    ],
                    [
                        'name' => 'Kick off',
                        'tag'  => 'kick_off',
                        'match_limits' => [
                            'min' => '12',
                            'max' => '12'
                        ],
                        'gameTypes' => [
                            [
                                'name' => 'Solo',
                                'tag'  => 'solo',
                                'team_size' => 1
                            ], [
                                'name' => 'Duo',
                                'tag'  => 'duo',
                                'team_size' => 2
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($games as $game) {
            $gameItem = Game::create([
                'name'          => $game['name'],
                'tag'           => $game['tag'],
                'image'         => $game['image'],
                'cover'         => $game['cover'],
            ]);

            $gamePlatformIds = GamePlatform::whereIn('type',$game['platforms'])->pluck('id');
            $gameItem->gamePlatforms()->sync($gamePlatformIds);

            foreach ($game['gameModes'] as $gameMode) {
                $gameModeMatchLimits = MatchLimit::where('max', $gameMode['match_limits']['max'])
                    ->where('min', $gameMode['match_limits']['min'])->first();

                $gameModeItem = GameMode::create([
                    'name' => $gameMode['name'],
                    'game_id' => $gameItem->id,
                    'tag' => $gameItem->tag . '_' . $gameMode['tag'],
                    'match_limits_id' => $gameModeMatchLimits? $gameModeMatchLimits->id : 0
                ]);

                foreach ($gameMode['gameTypes'] as $gameType) {
                    $teamSizeId = TeamSize::where('size', $gameType['team_size'])->first()->id;

                    GameType::create([
                        'name' => $gameType['name'],
                        'game_mode_id' => $gameModeItem->id,
                        'tag' => $gameItem->tag . '_' . $gameMode['tag'] . '_' . $gameType['tag'],
                        'team_size_id' => $teamSizeId
                    ]);
                }
            }

            foreach ($game['tournamentSizes'] as $tournamentSize) {
                TournamentSize::create([
                    'game_id' => $gameItem->id,
                    'players_count' => $tournamentSize,
                ]);
            }
        }

    }
}
