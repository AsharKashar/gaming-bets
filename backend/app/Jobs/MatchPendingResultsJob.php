<?php

namespace App\Jobs;

use App\Model\Match;
use App\Model\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MatchPendingResultsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Match $match;
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @param Match $match
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
        $statusId = Status::getIdByMatchType(Status::MATCH_TYPES['pending_results']);
        $this->match->update([
            'status_id' => $statusId
        ]);
    }
}
