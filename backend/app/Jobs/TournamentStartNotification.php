<?php

namespace App\Jobs;

use App\Model\Tournament;
use App\Service\NotificationsService;
use App\Service\TournamentService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TournamentStartNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tournament;
    public $tries = 3;


    /**
     * Create a new job instance.
     *
     * @param $tournamentId
     */
    public function __construct($tournamentId)
    {
        $this->tournament = Tournament::find($tournamentId);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notificationDelay = TournamentService::getTournamentDelays($this->tournament)['start_notification'];

        if ($notificationDelay <= 0) {
            NotificationsService::tournamentWillStartSoon($this->tournament);
        } else {
            $job = (new TournamentStartNotification($this->tournament->id))
                ->delay(Carbon::now()->addSeconds($notificationDelay))
                ->onQueue('bangergames');
            dispatch($job);
        }
    }
}
