<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.home');

    // admin routes
    $router->resource('currencies', CurrenciesController::class);
    $router->resource('countries', CountryController::class);
    $router->resource('locales', LocaleController::class);
    $router->resource('regions', RegionController::class);
    $router->resource('settings', SettingsController::class);
    $router->resource('statuses', StatusController::class);

    // Game Management
    $router->resource('games', GamesController::class);
    $router->resource('game-modes', GameModeController::class);
    $router->resource('game-platforms', GamePlatformController::class);
    $router->resource('game-types', GameTypeController::class);
    $router->resource('game-type-boxmatches', GameTypeBoxmatchController::class);
    $router->resource('match-limits', MatchLimitController::class);
    $router->resource('match-maps', MatchMapsController::class);
    $router->resource('match-types', MatchTypeController::class);
    $router->resource('steam-server-tokens', SteamServerTokenController::class);
    $router->resource('team-sizes', TeamSizeController::class);
    $router->resource('tournament-sizes', TournamentSizeController::class);
    $router->resource('tournament-types', TournamentTypeController::class);


    // tournament flow
    $router->resource('tournaments', TournamentController::class);
    $router->group(['prefix' => 'tournament-tools'], function ($router) {
        $router->post('add-demo-players/{id}', 'TournamentToolsController@addDemoPlayers');
        $router->post('add-demo-teams/{id}', 'TournamentToolsController@addDemoTeams');
        $router->get('end-registration/{id}', 'TournamentToolsController@endRegistration');
        $router->get('start-registration/{id}', 'TournamentToolsController@startRegistration');
        $router->get('prepare-structure/{id}', 'TournamentToolsController@prepareStructure');
    });
    $router->resource('matches', MatchesController::class);
    $router->post('matches/{match:match_id}/set-places', 'MatchesController@setPlaces');
    $router->resource('cs-go-servers', CsGoServerController::class);
    $router->resource('dathost', DatHostController::class);
    $router->group(['prefix' => 'dathost'], function ($router) {
        $router->post('createServer', 'DatHostController@createServer');
        $router->get('server/{action}/{id}', 'DatHostController@actionServer');
        $router->post('server/{action}/{id}', 'DatHostController@actionServer');
    });
    $router->resource('report-issues', ReportIssuesController::class);
    $router->resource('entry-fees', EntryFeeController::class);
    $router->resource('evidence', EvidenceController::class);
    $router->resource('frequencies', FrequencyController::class);
    $router->resource('match-reports', MatchReportController::class);
    $router->resource('match-teams', MatchTeamController::class);
    $router->resource('match-users', MatchUserController::class);
    $router->resource('team-tournaments', TeamTournamentController::class);
    $router->resource('team-tournament-users', TeamTournamentUserController::class);
    $router->resource('tournament-options', TournamentOptionsController::class);
    $router->resource('tournament-prizes', TournamentPrizeController::class);
    $router->resource('tournament-results', TournamentResultController::class);



    // boxmatches
    $router->resource('box-matches-all', BoxMatcheAllsController::class);
    $router->resource('box-matches-conflict', BoxMatchesController::class);
    $router->resource('box-match-rules', BoxMatchRuleController::class);
    $router->resource('box-match-invites', BoxMatchInviteController::class);
    $router->resource('box-match-results', BoxMatchResultController::class);
    $router->resource('box-match-users', BoxMatchUserController::class);
    $router->group(['prefix' => 'box-match'], function ($router) {
        $router->get('delete-match-conflict/{id}', 'BoxMatchesController@deleteMatchAdmin');
        $router->post('conflict-Resolve/{match_id}', 'BoxMatchesController@adminResult');
        $router->get('delete-match/{id}', 'BoxMatcheAllsController@deleteMatchAdmin');
    });


    //audience
    $router->resource('user', UserController::class);
    $router->resource('teams', TeamController::class);
    $router->resource('user-notifications', NotificationController::class);
    $router->resource('team-invites', TeamInviteController::class);
    $router->resource('user-connections', UserConnectionController::class);
    $router->resource('user-points-histories', UserPointsHistoryController::class);
    $router->resource('user-game-statistics', UserGameStatisticController::class);

    // news
    $router->resource('news-categories', BlogCategoryController::class);
    $router->resource('news-posts', BlogPostController::class);
    $router->resource('faq-catagories', FaqCatagoriesController::class);
    $router->resource('faq-questions', FaqQuestionsController::class);
    $router->resource('faq-ask-questions', FaqAskQuestionController::class);
    $router->post('file_upload', 'UploadController@uploadFileToS3');


    // membership
    $router->resource('bomb-package', BombPackageController::class);
    $router->resource('membership-package', MemberShipPackageController::class);
    $router->resource('memberships', MemberShipController::class);
    $router->apiResource('global-options', GlobalOptionsController::class);
    $router->resource('payment-history', PaymentHistoryController::class);
    $router->resource('payment-methods', PaymentMethodController::class);
    $router->resource('withdrawal', WithdrawalController::class);
    $router->resource('bomb-histories', BombHistoryController::class);
    $router->resource('cards', CardController::class);
    $router->resource('user-bombs', UserBombsController::class);

    // Point System
    $router->resource('user-levels', UserLevelController::class);
    $router->resource('user-points', UserPointController::class);

    // Leaderboards
    $router->resource('leaderboards', LeaderboardController::class);
});
