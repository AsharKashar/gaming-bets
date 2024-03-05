<?php

namespace App\Admin\Actions\Tournaments;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class CancelMatch extends RowAction
{
    public $name = 'Cancel Match';

    public function handle(Model $model)
    {
        // TODO: cancel match here

        return $this->response()->warning('Match cancelled.')->refresh();
    }

}
