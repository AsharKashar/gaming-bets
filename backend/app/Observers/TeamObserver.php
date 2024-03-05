<?php

namespace App\Observers;

use App\Model\Team;

class TeamObserver
{
    /**
     * Handle the team "created" event.
     *
     * @param  \App\Model\Team  $team
     * @return void
     */
    public function created(Team $team)
    {
        $team->token =  hash('sha256',microtime());
        $team->save();
    }

    /**
     * Handle the team "updated" event.
     *
     * @param  \App\Model\Team  $team
     * @return void
     */
    public function updated(Team $team)
    {
        if (!$team->token) {
            $team->token =  hash('sha256',microtime());
            $team->save();
        }
    }
}
