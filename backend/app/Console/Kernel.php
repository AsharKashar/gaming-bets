<?php

namespace App\Console;

use App\Console\Commands\BracketGoLive;
use App\Console\Commands\BoxMatchesGoLive;
use App\Console\Commands\BoxMatchesDecision;
use App\Console\Commands\BoxMatchesMatchEnd;
use App\Console\Commands\PreTournamentUpdate;
use App\Console\Commands\RenewMembershipRecords;
use App\Console\Commands\RewardTeams;
use App\Console\Commands\SystemCancellation;
use App\Console\Commands\TopMonthlyPlayer;
use App\Console\Commands\TournamentStatusUpdate;
use App\Console\Commands\BoxMatchesAddFreeMonthly;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        BoxMatchesGoLive::class,
        BoxMatchesDecision::class,
        BoxMatchesMatchEnd::class,
        RenewMembershipRecords::class,
        SystemCancellation::class,
        TopMonthlyPlayer::class,
        BoxMatchesAddFreeMonthly::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //box fights
        $schedule->command('boxmatch:endconflict')->everyMinute();
        $schedule->command('boxmatch:live')->everyMinute();
        $schedule->command('boxmatch:decision')->everyMinute();
        $schedule->command('boxmatch:end')->everyMinute();
        $schedule->command('boxmatch:cancel')->everyMinute();
        $schedule->command('boxmatch:add-free-monthly')->daily();

        //membership
        $schedule->command('membership:renewdata')->everyTenMinutes();

        //leaderboard
        $schedule->command('leaderboard:topplayer')->monthlyOn(1,'12:00');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
