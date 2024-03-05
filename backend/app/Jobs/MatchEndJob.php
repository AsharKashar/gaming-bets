<?php

namespace App\Jobs;

use App\Model\Match;
use App\Model\Status;
use App\Service\BracketService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MatchEndJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Match $match;
    public $tries = 3;
    protected BracketService $bracketService;

    /**
     * MatchEndJob constructor.
     * @param  Match  $match
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
        $this->bracketService = new BracketService();
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->match->winnerTeam()) {
            $this->match->randomWinner();
        }

        $this->match->update([
            'status_id' => Status::getIdByMatchType(Status::MATCH_TYPES['ended'])
        ]);
    }
}
