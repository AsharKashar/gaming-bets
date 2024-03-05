<?php

//Route::redirect('home', 'admin');
//Route::group(['prefix' => 'admin'], function () {
//    Auth::routes();
//    Route::group(['middleware' => 'admin'], function () {
//        Route::get('/', 'HomeController@index')->name('home');
//
//        /*==========================    Games Routes    ==========================*/
//        Route::get("bracket", "GamesController@bracket")->name("pages.bracket");
//        Route::get("boxfight", "GamesController@boxfight")->name("pages.boxfight");
//        Route::get("games", "GamesController@index")->name("pages.games");
//        Route::post("games", "GamesController@save");
//        Route::patch("edit-game-{id}", "GamesController@edit")->name("edit.games");
//        Route::delete("delete-game-{game}", "GamesController@delete")->name("delete.games");
//
//
//        /*==========================    Tournament Routes    ==========================*/
//
//        Route::get('search', ['as' => 'search', 'uses' => 'Admin\TournamentController@search']);
//        Route::get('tournament', ['as' => 'pages.tournament', 'uses' => 'Admin\TournamentController@index']);
//        Route::get('add/tournament', ['as' => 'add.tournament', 'uses' => 'Admin\TournamentController@addForm']);
//        Route::post('add/tournament', 'Admin\TournamentController@addTournament');
//        Route::get('edit/tournament/{tournament}', ['as' => 'edit.tournament', 'uses' => 'Admin\TournamentController@editForm']);
//        Route::patch('edit/tournament/{tournament}', 'Admin\TournamentController@updateTournament');
//        Route::delete('delete/tournament/{tournament}', ['as' => 'delete.tournament', 'uses' => 'Admin\TournamentController@deleteTournament']);
//
//        Route::get('send-email/tournament/{tournament}', ['as' => 'pages.email.send', 'uses' => 'Admin\TournamentController@emailForm']);
//        Route::post('send-email/tournament/{tournament}', 'Admin\TournamentController@sendMail');
//        Route::get('end/tournament/{tournament}', ['as' => 'tournament.close', 'uses' => 'Admin\TournamentController@endTournament']);
//        Route::get('rematch/tournament/{tournament}', ['as' => 'tournament.rematch', 'uses' => 'Admin\TournamentController@rematchForm']);
//        Route::post('rematch/tournament/{tournament}', ['uses' => 'Admin\TournamentController@rematch']);
//
//
//        Route::get('tournament/{tournament}/add-result', ['as' => 'add.result', 'uses' => 'Admin\TournamentController@addResultForm']);
//        Route::post('tournament/{tournament}/add-result', 'Admin\TournamentController@addResult');
//
//        Route::get('tournament/{tournament}/end-round', 'Admin\TournamentController@endRound')->name('tournament.end_round');
//
////        Route::get('tournament/{tournament}/matches', ['as' => 'tournament.matches', 'uses' => 'Admin\TournamentController@showMatches']);
////        Route::post('tournament/{tournament}/matches', ['as' => 'tournament.matches', 'uses' => 'Admin\TournamentController@assignWinnerForTeamBase']);
//        Route::get('match-add-winner/{match}', ['as' => 'matches.winner', 'uses' => 'Admin\MatchController@createWinners']);
//        Route::post('match-add-winner/{match}', ['uses' => 'Admin\MatchController@storeWinners']);
//
//        Route::get('close-match-{match}', ['as' => 'matches.close', 'uses' => 'Admin\MatchController@closeMatch']);
//
//        /*==========================    Match Routes    ==========================*/
//
//        //        Route::get('matches', ['as' => 'pages.matches', 'uses' => 'Admin\MatchController@index']);
//        //        Route::get('tournament/{tournament}/add-match', ['as' => 'add.match', 'uses' => 'Admin\MatchController@addMatchForm']);
//        //        Route::post('tournament/{tournament}/add-match', 'Admin\MatchController@addMatch');
//        //        Route::get('tournament/{tournament}/edit-match/{match}', ['as' => 'edit.match', 'uses' => 'Admin\MatchController@editMatchForm']);
//        //        Route::patch('tournament/{tournament}/edit-match/{match}', 'Admin\MatchController@updateMatch');
//        //        Route::delete('delete-match/{match}', ['as' => 'delete.match', 'uses' => 'Admin\MatchController@deleteMatch']);
//        //        Route::get('change-status/match/{match}/{status}',['as' => 'change.match.status', 'uses' => 'Admin\MatchController@changeStatusMatch']);
//        //        Route::post('match-add-winner/{match}', ['as'=>'match.save.winner','uses'=>'Admin\MatchController@addWinnerMatch']);
//
//        /*==========================    Other Routes    ==========================*/
//
//        Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
//        Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
//        Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
//        Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
//        Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
//        Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
//        Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
//
//        /*==========================    Profile Routes    ==========================*/
//
////        Route::resource('user', 'UserController', ['except' => ['show']]);
////        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
////        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
////        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
//
//
//        /*==========================    Blog Routes    ==========================*/
//
//        Route::get('all-posts', ['as' => 'post.list', 'uses' => 'Admin\BlogController@listPost']);
//        Route::get('add-post', ['as' => 'post.create', 'uses' => 'Admin\BlogController@createPost']);
//        Route::post('add-post', ['uses' => 'Admin\BlogController@storePost']);
//        Route::get('edit-post-{post}', ['as' => 'post.edit', 'uses' => 'Admin\BlogController@editPost']);
//        Route::patch('edit-post-{post}', ['uses' => 'Admin\BlogController@updatePost']);
//        Route::delete('post-{post}', ['as' => 'post.delete', 'uses' => 'Admin\BlogController@deletePost']);
//
//        Route::get('categories', 'Admin\BlogController@categories')->name('categories.index');
//        Route::get('issues', 'Admin\IssueController@index')->name('issue.index');
//        Route::patch('issue-update-{category}', 'Admin\IssueController@update')->name('issue.update');
//        Route::post('categories', 'Admin\BlogController@storeCategories')->name('categories.store');
//        Route::patch('categories-{category}', 'Admin\BlogController@updateCategories')->name('categories.update');
//        Route::delete('categories-{category}', 'Admin\BlogController@deleteCategories')->name('categories.delete');
//    });
//});

Route::get('invite/{token}','TeamController@joinTeam')->name('user.invite');
