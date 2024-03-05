<?php

namespace App\Providers;

use App\Model\BlogPost;
use App\Model\BombHistory;
use App\Model\DatHost\CsGoServer;
use App\Model\Match;
use App\Model\MatchTeam;
use App\Model\Team;
use App\Model\TeamTournament;
use App\Model\UserPointsHistory;
use App\Observers\Dathost\CsGoServerObserver;
use App\Observers\MatchObserver;
use App\Observers\MatchTeamObserver;
use App\Observers\UserPointsHistoryObserver;
use App\Relations\TeamUserRelation;
use App\Model\Tournament;
use App\Observers\BlogPostObserver;
use App\Observers\BombHistoryObserver;
use App\Observers\TeamUserRelationObserver;
use App\Observers\TeamObserver;
use App\Observers\TeamTournamentObserver;
use App\Observers\TournamentObserver;
use Encore\Admin\Config\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $table = config('admin.extensions.config.table', 'admin_config');
        if (Schema::hasTable($table)) {
            Config::load();
        }
        BlogPost::observe(BlogPostObserver::class);
        Team::observe(TeamObserver::class);
        Tournament::observe(TournamentObserver::class);
        TeamTournament::observe(TeamTournamentObserver::class);
        BombHistory::observe(BombHistoryObserver::class);
        TeamUserRelation::observe(TeamUserRelationObserver::class);
        UserPointsHistory::observe(UserPointsHistoryObserver::class);
        Match::observe(MatchObserver::class);
        MatchTeam::observe(MatchTeamObserver::class);
        CsGoServer::observe(CsGoServerObserver::class);
    }
}
