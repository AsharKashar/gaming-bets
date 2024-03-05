<?php

namespace App\Admin\Actions\Tournaments;

use App\Model\MatchTeam;
use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class BatchRandomWinner extends BatchAction
{
    public $name = 'batch random winner';

    public function handle(Collection $collection)
    {
        foreach ($collection as $model) {
            $model->randomWinner();
        }

        return $this->response()->success('Success message...')->refresh();
    }

}
