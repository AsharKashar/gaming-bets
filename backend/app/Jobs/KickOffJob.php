<?php

namespace App\Model\Jobs;

use App\Model\Match;
use App\Model\Tournament;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KickOffJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $tournament;
    public $tries = 3;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tournament = $this->tournament;
        Match::where('round', $tournament->rounds_finished)->where('tournament_id', $tournament->id)->update(
            [
                'close_for1' => 1,
                'close_for2' => 1,
            ]
        );
        $matches = Match::where('tournament_id', $tournament->id)->where('round', $tournament->rounds_finished)->get();
        foreach ($matches as $match) {
            if ($match->e_image1 == '' && $match->e_image2 != '') {
                $match->winner_id = $match->team_1;
                $match->save();
            } elseif ($match->e_image2 == '' && $match->e_image1 != '') {
                $match->winner_id = $match->team_2;
                $match->save();
            } elseif ($match->e_image1 == '' && $match->e_image2 == '') {
                $match->winner_id = 0;
                $match->save();
            }
        }
    }
}
