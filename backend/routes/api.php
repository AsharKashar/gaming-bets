<?php

// Auth
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('profile/get-me', 'ProfileController@getMe');
    Route::post('/auth/logout', 'AuthController@logout');
    Route::get('/auth/me', 'AuthController@me');
    Route::get('/auth/check', 'AuthController@check');
    Route::get('/steam/auth', 'SteamAuthController@redirectToSteam');
});
// TODO: set ?token= by vuex and change hardcoded user id to auth()->user()->id
Route::get('/steam/auth/handle', 'SteamAuthController@handle');

Route::post('/auth/register', 'AuthController@register');
Route::post('/auth/login', 'AuthController@login');
Route::get('/auth/get-user-id', 'UserController@getUserId');

// Profile
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/profile/changePassword', 'ProfileController@changePassword');
    Route::post('/profile/updateProfile', 'ProfileController@updateProfile');
    Route::post('/profile/getStats', 'ProfileController@getStats');
    Route::get('/profile/payment/history', 'ProfileController@getPaymentHistory');
    Route::get('/profile/payment/cards', 'ProfileController@getPaymentsMethods');
    Route::post('/profile/updateAvatar', 'ProfileController@UpdateAvatar');
    Route::post('/profile/withdrawal', 'ProfileController@saveWithdrawal');
    Route::get('/profile/getWithdrawal', 'ProfileController@getWithdrawal');
    Route::post('/profile/statistic', 'ProfileController@getStatistic');
});

// Payment
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/payment/addcart', 'PaymentController@addCart');
    Route::get('/payment/cards', 'PaymentController@getCart');
});

// Tournaments
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/tournaments/joined', 'TournamentController@joinedTournaments');
});

Route::apiResource('/game-modes/{gameMode}/rules', GameModeRulesController::class)->except('show');
Route::apiResource('/tournament/options', TournamentOptionsController::class);
Route::post('/tournament/options/type', 'TournamentOptionsController@getTournamentOptionsByType');
Route::get('/game/get-game-modes','GamesModeController@index');

// Homepage
Route::get('/home/monthly-top-player','HomeController@getTopThreeOfMonth');

// Box Matches
Route::post('/box-matches/view-boxfights-user','BoxMatchesController@boxfights');
Route::patch('/box-matches/update','BoxMatchesController@update');
Route::post('/box-matches/check-if-team-full/{id}','BoxMatchesController@checkIfTeamFull');
Route::get('/box-matches/view-boxfight/{id}','BoxMatchesController@viewBoxFight');
Route::get('/box-matches/view-boxfights','BoxMatchesController@view');
Route::get('/box-matches/view-boxfight-team/{id}','BoxMatchesController@viewBoxFightTeam');
Route::post('/box-matches/result-update/{id}','BoxMatchesController@adminResult');
Route::post('/box-matches/get-team-evidence/{id}','BoxMatchesController@getEvidenceteam');
Route::get('/box-matches/get-deleted-matches','BoxMatchesController@getDeletedMatches');
Route::delete('/box-matches/delete/{id}','BoxMatchesController@deleteMatchAdmin');
Route::get('/box-matches/boxfights-ladder/{gameid}','BoxMatchesController@getBoxFightLadder');
Route::get('/box-matches/boxfights-invite-links/{id}','BoxMatchInviteController@getInviteLinks');
Route::get('/box-matches/get-game-types','GameTypeBoxmatchController@getGameTypeBoxFight');
Route::get('/box-matches/get-game-platforms/{game_id}','BoxMatchesController@getPlatformBoxFight');
Route::get('/box-matches/get-game-regions','BoxMatchesController@getRegionBoxFight');
Route::get('/box-matches/assign-boxfights/{id}','BoxMatchesController@assignFight');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::put('/box-matches/create','BoxMatchesController@create');
    Route::post('/box-matches/if-user-exists/{id}','BoxMatchesController@ifUserExists');
    Route::post('/box-matches/join-using-link/{id}','BoxMatchesController@join');
    Route::post('/box-matches/join-using-button/{id}','BoxMatchesController@joinButton');
    Route::post('/box-matches/view-boxfight-with-remark/{id}','BoxMatchesController@viewBoxFightRemark');
    Route::post('/box-matches/view-boxfight-history-with-remark/{id}','BoxMatchesController@viewBoxFightHistoryRemark');
    Route::post('/box-matches/status-update/{id}','BoxMatchesController@statusUpdate');
    Route::get('/box-matches/end-live-match/{id}','BoxMatchesController@endLiveMatch');
    Route::post('/box-matches/upload-evidence/{id}','BoxMatchesController@uploadEvidence');
});

// Box Matches Rules
Route::post('/box-match-rules/get-game-rule','BoxMatchRuleController@getRules');
Route::put('/box-match-rules/add-game-rules','BoxMatchRuleController@create');
Route::post('/box-match-rules/update-game-rules/{id}','BoxMatchRuleController@update');
Route::delete('/box-match-rules/delete-game-rules/{id}','BoxMatchRuleController@delete');

//FAQs
Route::get('/FAQ/get-catagories','FaqCatagoriesController@getCatagories');
Route::get('/FAQ/get-question/{question_id}','FaqQuestionsController@getQuestionAnswer');
Route::get('/FAQ/get-all-faqs','FaqCatagoriesController@getFaqs');
Route::get('/FAQ/get-catagory_faqs/{catagory_id}','FaqCatagoriesController@getCatagoryFaqs');
Route::get('/FAQ/search','FaqQuestionsController@searchQuestions');
Route::post('/FAQ/ask-question','FaqAskQuestionController@addQuestions');

// Tournament
Route::group(['middleware' => ['jwt.get']], function() {
    Route::get('/tournaments', 'TournamentController@list');
    Route::get('/tournaments/filters', 'TournamentController@getFilters');
    Route::get('/tournaments/{tournamentId}', 'TournamentController@show');
});

Route::get('/tournaments/{tournament}/teams', 'TournamentController@getTeamTournament');
Route::get('/tournaments/{tournament}/rules', 'TournamentController@getTournamentRules');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/tournaments/{tournament}/join', 'TournamentController@joinTournament');
    Route::get('/tournaments/{tournament}/teams/user', 'TournamentController@getCurrentUserTeamsTournament');
});

//Brackets
Route::group(['middleware' => ['jwt.get']], function() {
    Route::get('/bracket-match/view-bracket-structure/{tournament_id}', 'MatchesController@viewStructure');
    Route::get('/bracket-match/view-matches/{match_id}', 'MatchesController@getMatch');
    Route::get('/bracket-match/view-final/{tournament_id}', 'MatchesController@getFinal');
    Route::post('/bracket-match/report-match-upload/{report_id}', 'MatchesController@reportMatchUpload');
    Route::post('/bracket-match/report-match-details/{match_id}', 'MatchesController@reportMatchDetails');
});

Route::group(['middleware' => ['jwt.get']], function() {
    Route::get('/tournaments/{tournament}/matches', 'MatchesController@getTournamentMatches');
    Route::get('/tournaments/{tournament}/brackets', 'MatchesController@getTournamentBrackets');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/matches/{match:match_id}/upload-evidence', 'MatchesController@uploadEvidence');
});

Route::get('/bracket-match/view-ladder/{tournament_id}', 'MatchesController@getTournamentladder');
Route::get('/bracket-match/view-bracket/{tournament_id}', 'MatchesController@getlad');

// Games
Route::get('/games','GamesController@getGameList');
Route::get('/games/{game}','GamesController@show');
Route::get('/game/get-rules/{id}','GamesController@getRules');

// Membership
Route::post('/membership/create-membership-subscription','MembershipController@addMembershipRecord');
Route::post('/membership/create-membership-subscription-using-token','MembershipController@createTokenMembership');
Route::delete('/membership/cancel-subscription/{id}','MembershipController@cancelSubscription');
Route::post('/membership/get-invoice-package-change/{id}','MembershipController@retrieveInvoiceForRemainingMonth');
Route::post('/membership/update-membership/{id}','MembershipController@updateMembershipRecord');
Route::get('/membership/check-if-exists/{id}','MembershipController@checkIfExists');
Route::get('/membership/get-all-memberships','MembershipController@viewAllMemberships');
Route::get('/membership/check-if-active/{id}','MembershipController@checkIfMembershipActive');
Route::get('/membership/deactivate-membership/{id}','MembershipController@deactivateMembership');
Route::get('/membership/get-deleted-membership','MembershipController@getDeletedMemeberships');

//Membership webhook
Route::post('/webhook/call-backs','WebhookController@webhookCheck');

// Bomb
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/payment/bomb-purchase-token','BombController@bombPurchaseWithToken');
    Route::post('/payment/bomb-purchase-payment-method/{id}','BombController@bombPurchaseWithPaymentMethod');
    Route::get('/payment/get-user-bombs/{id}','BombController@getUserBombs');
    Route::get('/payment/get-bombs-withdrawable/{id}','BombController@getUsersWithdrawableBombs');
});

// Bomb Packages
Route::get('/bomb-package/get-packages','BombPackageController@getPackages');
Route::get('/bomb-package/get-package/{id}','BombPackageController@getPackage');
Route::put('/bomb-package/create','BombPackageController@insertPackage');
Route::post('/bomb-package/update/{id}','BombPackageController@updatePackage');
Route::delete('/bomb-package/delete-package/{id}','BombPackageController@deletePackage');

// Card
Route::get('/card/view-all','CardController@getall');
Route::delete('/card/delete-card/{cardID}','CardController@deleteCard');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/card/add-payment-method/{id}','CardController@attachPaymentMethod');
    Route::post('/card/make-default-payment-method/{id}','CardController@makeDefault');
    Route::get('/card/view-cards/{id}','CardController@view');
    Route::get('/card/view-default/{id}','CardController@viewDefault');
    Route::get('/card/get-deleted-cards','CardController@getDeletedCards');
});

// Payment-History
Route::get('/payment/payment-history/{id}','PackagesController@getPaymentHistory');

// Packages
Route::get('/packages/view','PackagesController@view');
Route::get('/packages/get-package/{id}','PackagesController@getPackage');
Route::put('/packages/create','PackagesController@create');
Route::post('/packages/update/{id}','PackagesController@update');
Route::post('/packages/update-stripe-components/{id}','PackagesController@updateStripeComponents');
Route::delete('/packages/delete/{id}','PackagesController@delete');
Route::get('/packages/get-deleted-packages','PackagesController@getDeletedPackages');

// Leaderboard
Route::post('/leaderboard/get-gameleaderboard','LeaderBoardController@getLeaderboard');
Route::post('/leaderboard/get-game-topthree','LeaderBoardController@getGameTopThree');
Route::get('/leaderboard/monthly-top-player','LeaderBoardController@getTopThreeOfMonth');
Route::get('/leaderboard/get-history-top-monthly','LeaderBoardController@getDeletedTopThreeOfMonth');


// Team
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/team','TeamController@list');
    Route::post('/team','TeamController@create');
    Route::post('/team/{team}/invite','TeamController@invite');
    Route::delete('/team/user','TeamController@deleteUser');
    Route::post('/team/join/team-token','TeamController@joinTeamByTeamToken');
    Route::get('/team-size', 'TeamSizeController@list');

    Route::post('/team/{team_invite}/invite','TeamInviteController@deleteInvite');
    //Route::post('/team/relation','TeamController@teamRelation');
    //Route::post('/team/edit/{id}','TeamController@edit');
    //Route::post('/team/detail','TeamController@detail');
    //Route::delete('/team','TeamController@delete');
});
// User
Route::get('/users/{id}','UserController@show');
Route::post('/user/all','UserController@all');
Route::post('/user/detail','UserController@detail');
Route::post('/user/edit/{id}','UserController@userEdit');
Route::delete('/user/{id}','UserController@delete');

//Blog
Route::get('/blog/categories','BlogController@getMainCategories');
Route::get('/blog/posts','BlogController@getPosts');
Route::get('/blog/available-slugs/{type}','BlogController@getSlugsList');
Route::get('/blog/{category_slug}','BlogController@getCategoryDetails');
Route::get('/blog/{category_slug}/{post_slug}','BlogController@getBlogPost');
Route::get('/preview/news/{blog_post}','BlogController@getBlogPostPreview');
Route::post('/blog/subscribe','BlogController@subscribeEmail');


// Social auth
Route::get('/oauth/callback', 'SocialOAuthController@oAuthCallback');
Route::post('/oauth/create-user', 'SocialOAuthController@createUser');
Route::post('/oauth/connect-account', 'SocialOAuthController@connectAccount');

// Notifications
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/notify-test/{type}', 'UserNotificationController@testNotification');
    Route::get('/notifications', 'UserNotificationController@getUserNotifications');
    Route::post('/notifications/read', 'UserNotificationController@readAllUserNotifications');
});
Route::get('/notifications/filters', 'UserNotificationController@getNotificationFilters');


// Country

Route::get('/countries', 'CountryController@index');

// Test route
Route::post('/dathost/account-info', 'DatHostController@getAccountInfo');

//Sitemap/Rss
Route::get('/dynamic-slugs','SlugsController@getSlugsList');
Route::get('/rss-info/{locale}','SlugsController@getRssInfo');

//Test Notification (Aanif)
Route::get('/test/all/{id}', 'UserNotificationController@getall');
Route::post('/test/send/{id}', 'UserNotificationController@send');
