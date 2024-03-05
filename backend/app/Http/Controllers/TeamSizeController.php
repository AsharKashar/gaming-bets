<?php

namespace App\Http\Controllers;

use App\Model\TeamSize;

class TeamSizeController extends Controller
{
    public function list()
    {
        return $this->successApiResponse(TeamSize::all());
    }
}
