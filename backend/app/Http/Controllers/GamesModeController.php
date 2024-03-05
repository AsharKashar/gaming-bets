<?php

namespace App\Http\Controllers;

use App\Model\GameMode;
use Illuminate\Http\Request;

class GamesModeController extends Controller
{
    //
     /**
     * @OA\Get(
     *     path="/api/game/get-game-modes",
     *     tags={"Game-modes"},
     *     @OA\Response(response="200", description="Get game modes made available from admin panel")
     * )
     */
    public function index()
    {
        return GameMode::where('available',true)->get();
    }
}
