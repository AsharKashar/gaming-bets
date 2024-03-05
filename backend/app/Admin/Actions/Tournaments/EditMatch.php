<?php

namespace App\Admin\Actions\Tournaments;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class EditMatch extends RowAction
{
    public $name = 'Edit Match';

    public function href()
    {
        return admin_url("/matches/{$this->row->match_id}/edit");
    }

}
