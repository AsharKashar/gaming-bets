<?php

namespace App\Jobs;

use App\Model\Match;
use App\Service\DatHostService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MatchBeforeStartJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Match $match;
    public $tries = 3;

    /**
     * MatchStartNotificationJob constructor.
     * @param  Match  $match
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(
            $this->match->tournament->game->tag === 'csgo' &&
            $this->match->tournament->game->automationProvider === 'dathost'
        ) {
            $datHostService = new DatHostService();
            $datHostService->assignAvailableServer($this->match);
        }
    }
}
