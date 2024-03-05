<?php

use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Menu;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add default menus.
        Menu::truncate();

        // Add parents
        Menu::insert(
            [
                [
                    'parent_id' => 0,
                    'order' => 1,
                    'title' => 'Dashboard',
                    'icon' => 'fa-bar-chart',
                    'uri' => '/',
                ],
                [
                    'parent_id' => 0,
                    'order' => 2,
                    'title' => 'Admin',
                    'icon' => 'fa-tasks',
                    'uri' => 'admin',
                ],
                [
                    'parent_id' => 0,
                    'order' => 3,
                    'title' => 'Tournament Flow',
                    'icon' => 'fa-bars',
                    'uri' => 'tournament-flow',
                ],
                [
                    'parent_id' => 0,
                    'order' => 4,
                    'title' => 'Box Matches Flow',
                    'icon' => 'fa-cube',
                    'uri' => 'boxmatches-flow',
                ],
                [
                    'parent_id' => 0,
                    'order' => 5,
                    'title' => 'Membership',
                    'icon' => 'fa-cube',
                    'uri' => 'membership',
                ],
                [
                    'parent_id' => 0,
                    'order' => 6,
                    'title' => 'Audience',
                    'icon' => 'fa-bars',
                    'uri' => 'audience',
                ],
                [
                    'parent_id' => 0,
                    'order' => 7,
                    'title' => 'Content Management',
                    'icon' => 'fa-bold',
                    'uri' => 'content-management',
                ],
                [
                    'parent_id' => 0,
                    'order' => 8,
                    'title' => 'Game Management',
                    'icon' => 'fa-bold',
                    'uri' => 'game-management',
                ],
                [
                    'parent_id' => 0,
                    'order' => 9,
                    'title' => 'Leaderboards',
                    'icon' => 'fa-bold',
                    'uri' => 'leaderboards',
                ],
                [
                    'parent_id' => 0,
                    'order' => 10,
                    'title' => 'Point System',
                    'icon' => 'fa-bold',
                    'uri' => 'point-system',
                ],
            ]
        );

        // Admin submenu
        Menu::insert([
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Global Options',
                'icon' => 'fa-dedent',
                'uri' => '/global-options/',
            ],
            [
                'parent_id' => 2,
                'order' => 1,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
            ],
            [
                'parent_id' => 2,
                'order' => 2,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Currencies',
                'icon' => 'fa-money',
                'uri' => 'currencies',
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Countries',
                'icon' => 'fa-money',
                'uri' => 'countries',
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Locales',
                'icon' => 'fa-money',
                'uri' => 'locales',
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Regions',
                'icon' => 'fa-money',
                'uri' => 'regions',
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Settings',
                'icon' => 'fa-money',
                'uri' => 'settings',
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Status',
                'icon' => 'fa-money',
                'uri' => 'statuses',
            ]
        ]);

        // add role to menu.
//        Menu::find(2)->roles()->save(\Encore\Admin\Auth\Database\Role::first());


        $tournamentFlowParentId = DB::table('admin_menu')->where('uri','=','tournament-flow')->first()->id;
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 0,
                'title' => 'Tournaments',
                'icon' => 'fa-bars',
                'uri' => 'tournaments',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 1,
                'title' => 'Matches',
                'icon' => 'fa-bars',
                'uri' => 'matches',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 3,
                'title' => 'CS:Go Servers',
                'icon' => 'fa-bars',
                'uri' => 'cs-go-servers',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 4,
                'title' => 'Dathost Management',
                'icon' => 'fa-bars',
                'uri' => 'dathost',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Report Issues',
                'icon' => 'fa-bars',
                'uri' => 'report-issues',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Entry Fees',
                'icon' => 'fa-bars',
                'uri' => 'entry-fees',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Evidence',
                'icon' => 'fa-bars',
                'uri' => 'evidence',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Frequencies',
                'icon' => 'fa-bars',
                'uri' => 'frequencies',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Match Reports',
                'icon' => 'fa-bars',
                'uri' => 'match-reports',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Match Teams',
                'icon' => 'fa-bars',
                'uri' => 'match-teams',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Match Users',
                'icon' => 'fa-bars',
                'uri' => 'match-users',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Team Tournaments',
                'icon' => 'fa-bars',
                'uri' => 'team-tournaments',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Team Tournament Users',
                'icon' => 'fa-bars',
                'uri' => 'team-tournament-users',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Tournament Options',
                'icon' => 'fa-bars',
                'uri' => 'tournament-options',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Tournament Prizes',
                'icon' => 'fa-bars',
                'uri' => 'tournament-prizes',
            ],
            [
                'parent_id' => $tournamentFlowParentId,
                'order' => 5,
                'title' => 'Tournament Results',
                'icon' => 'fa-bars',
                'uri' => 'tournament-results',
            ]
        ]);

        $boxmatchParentId = DB::table('admin_menu')->where('uri','=','boxmatches-flow')->first()->id;
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $boxmatchParentId,
                'order' => 0,
                'title' => 'Box Match All',
                'icon' => 'fa-cube',
                'uri' => 'box-matches-all',
            ],
            [
                'parent_id' => $boxmatchParentId,
                'order' => 1,
                'title' => 'Box Match with Conflicts',
                'icon' => 'fa-cube',
                'uri' => 'box-matches-conflict',
            ],
            [
                'parent_id' => $boxmatchParentId,
                'order' => 2,
                'title' => 'Box Match Rule',
                'icon' => 'fa-dropbox',
                'uri' => 'box-match-rules',
            ],
            [
                'parent_id' => $boxmatchParentId,
                'order' => 2,
                'title' => 'Box Match Invites',
                'icon' => 'fa-dropbox',
                'uri' => 'box-match-invites',
            ],
            [
                'parent_id' => $boxmatchParentId,
                'order' => 2,
                'title' => 'Box Match Results',
                'icon' => 'fa-dropbox',
                'uri' => 'box-match-results',
            ],
            [
                'parent_id' => $boxmatchParentId,
                'order' => 2,
                'title' => 'Box Match Users',
                'icon' => 'fa-dropbox',
                'uri' => 'box-match-users',
            ]
        ]);

        $audienceParentId = DB::table('admin_menu')->where('uri','=','audience')->first()->id;
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $audienceParentId,
                'order' => 0,
                'title' => 'User',
                'icon' => 'fa-bars',
                'uri' => 'user',
            ],
            [
                'parent_id' => $audienceParentId,
                'order' => 0,
                'title' => 'Teams',
                'icon' => 'fa-users',
                'uri' => 'teams',
            ],
            [
                'parent_id' => $audienceParentId,
                'order' => 0,
                'title' => 'Notifications (For testing)',
                'icon' => 'fa-bar-chart',
                'uri' => 'user-notifications',
            ],
            [
                'parent_id' => $audienceParentId,
                'order' => 0,
                'title' => 'Team Invites',
                'icon' => 'fa-bar-chart',
                'uri' => 'team-invites',
            ],
            [
                'parent_id' => $audienceParentId,
                'order' => 0,
                'title' => 'User Connections',
                'icon' => 'fa-bar-chart',
                'uri' => 'user-connections',
            ],
            [
                'parent_id' => $audienceParentId,
                'order' => 0,
                'title' => 'User Points Histories',
                'icon' => 'fa-bar-chart',
                'uri' => 'user-points-histories',
            ],
            [
                'parent_id' => $audienceParentId,
                'order' => 0,
                'title' => 'User Game Statistics',
                'icon' => 'fa-bar-chart',
                'uri' => 'user-game-statistics',
            ],
        ]);

        $gameManagement = DB::table('admin_menu')->where('uri','=','game-management')->first()->id;
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $gameManagement,
                'order' => 0,
                'title' => 'Games',
                'icon' => 'fa-bars',
                'uri' => 'games',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 0,
                'title' => 'Game Modes',
                'icon' => 'fa-bars',
                'uri' => 'game-modes',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 0,
                'title' => 'Game Platforms',
                'icon' => 'fa-bars',
                'uri' => 'game-platforms',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 0,
                'title' => 'Game Types',
                'icon' => 'fa-bars',
                'uri' => 'game-types',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 0,
                'title' => 'Game Type Boxmatches',
                'icon' => 'fa-bars',
                'uri' => 'game-type-boxmatches',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 0,
                'title' => 'Match Limits',
                'icon' => 'fa-bars',
                'uri' => 'match-limits',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 2,
                'title' => 'Match Maps',
                'icon' => 'fa-bars',
                'uri' => 'match-maps',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 2,
                'title' => 'Match Types',
                'icon' => 'fa-bars',
                'uri' => 'match-types',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 2,
                'title' => 'Steam Server Tokens',
                'icon' => 'fa-bars',
                'uri' => 'steam-server-tokens',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 2,
                'title' => 'Team Sizes',
                'icon' => 'fa-bars',
                'uri' => 'team-sizes',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 2,
                'title' => 'Tournament Sizes',
                'icon' => 'fa-bars',
                'uri' => 'tournament-sizes',
            ],
            [
                'parent_id' => $gameManagement,
                'order' => 2,
                'title' => 'Tournament Types',
                'icon' => 'fa-bars',
                'uri' => 'tournament-types',
            ],
        ]);

        $cms = DB::table('admin_menu')->where('uri','=','content-management')->first()->id;
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $cms,
                'order' => 0,
                'title' => 'Categories',
                'icon' => 'fa-archive',
                'uri' => 'news-categories',
            ],
            [
                'parent_id' => $cms,
                'order' => 1,
                'title' => 'Posts',
                'icon' => 'fa-file-powerpoint-o',
                'uri' => 'news-posts',
            ],
            [
                'parent_id' => $cms,
                'order' => 1,
                'title' => 'FAQ Categories',
                'icon' => 'fa-file-powerpoint-o',
                'uri' => 'faq-catagories',
            ],
            [
                'parent_id' => $cms,
                'order' => 1,
                'title' => 'FAQ Questions',
                'icon' => 'fa-file-powerpoint-o',
                'uri' => 'faq-questions',
            ],
            [
                'parent_id' => $cms,
                'order' => 1,
                'title' => 'FAQ Ask Questions',
                'icon' => 'fa-file-powerpoint-o',
                'uri' => 'faq-ask-questions',
            ],

        ]);
        $pointSystem = DB::table('admin_menu')->where('uri','=','point-system')->first()->id;
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $pointSystem,
                'order' => 0,
                'title' => 'User Levels',
                'icon' => 'fa-archive',
                'uri' => 'user-levels',
            ],
            [
                'parent_id' => $pointSystem,
                'order' => 0,
                'title' => 'User Points',
                'icon' => 'fa-archive',
                'uri' => 'user-points',
            ],

        ]);


        $membershipId = DB::table('admin_menu')->where('uri', 'membership')->first()->id;
        DB::table('admin_menu')->insert(
            [
                [
                    'parent_id' => $membershipId,
                    'order' => 1,
                    'title' => 'Bomb Package',
                    'icon' => 'fa-bomb',
                    'uri' => 'bomb-package',
                ],
                [
                    'parent_id' => $membershipId,
                    'order' => 2,
                    'title' => 'Packages',
                    'icon' => 'fa-tag',
                    'uri' => 'membership-package',
                ],
                [
                    'parent_id' => $membershipId,
                    'order' => 3,
                    'title' => 'Memberships',
                    'icon' => 'fa-tag',
                    'uri' => 'memberships',
                ],
                [
                    'parent_id' => $membershipId,
                    'order' => 5,
                    'title' => 'Payment History',
                    'icon' => 'fa-bars',
                    'uri' => 'payment-history',
                ],
                [
                    'parent_id' => $membershipId,
                    'order' => 5,
                    'title' => 'Payment Method',
                    'icon' => 'fa-bars',
                    'uri' => 'payment-methods',
                ],
                [
                    'parent_id' => $membershipId,
                    'order' => 6,
                    'title' => 'Withdrawal',
                    'icon' => 'fa-bars',
                    'uri' => 'withdrawal',
                ],
                [
                    'parent_id' => $membershipId,
                    'order' => 7,
                    'title' => 'Bomb Histories',
                    'icon' => 'fa-bars',
                    'uri' => 'bomb-histories',
                ],
                [
                    'parent_id' => $membershipId,
                    'order' => 8,
                    'title' => 'Cards',
                    'icon' => 'fa-bars',
                    'uri' => 'cards',
                ],
                [
                    'parent_id' => $membershipId,
                    'order' => 8,
                    'title' => 'User Bombs',
                    'icon' => 'fa-bars',
                    'uri' => 'user-bombs',
                ]
            ],
        );


    }
}
