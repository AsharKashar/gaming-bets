<?php

namespace App\Http\Controllers;

use App\Model\Game;
use App\Model\Leaderboard;
use Illuminate\Http\Request;
use App\Model\Tournament;

class HomeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/home/monthly-top-player",
     *     tags={"home"},
     *     @OA\Response(response="200", description="This Months Top Three Players")
     * )
     */
    public function getTopThreeOfMonth()
    {
        return response()->json(Leaderboard::with('user')->get());
    }
}
