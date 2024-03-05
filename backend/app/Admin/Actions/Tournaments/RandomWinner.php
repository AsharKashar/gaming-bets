<?php

namespace App\Admin\Actions\Tournaments;

use App\Model\Match;
use App\Model\MatchTeam;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class RandomWinner extends RowAction
{
    public $name = 'Random Winner';

    public function handle(Match $match)
    {
        $match->randomWinner();

        return $this->response()->success('Success message.')->refresh();
    }

}
