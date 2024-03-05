<?php

namespace App\Jobs;

use App\Model\Status;
use App\Model\Tournament;
use App\Service\TournamentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class StartTournament implements ShouldQueue
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
        TournamentService::updateStatusTournament($this->tournament, Status::TOURNAMENT_TYPES['started']);
    }
}
