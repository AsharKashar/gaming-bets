<?php

namespace App\Http\Controllers;

use App\Model\GameTypeBoxmatch;
use Illuminate\Http\Request;

class GameTypeBoxmatchController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/box-matches/get-game-types",
     *     tags={"box-matches"},
     *     @OA\Response(response="200", description="Get available game types for box match")
     * )
     */
    public function getGameTypeBoxFight()
    {
        $data = GameTypeBoxmatch::all();
        return $data;
    }
}
