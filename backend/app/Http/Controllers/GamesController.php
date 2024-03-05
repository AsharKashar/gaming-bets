<?php

namespace App\Http\Controllers;

use App\Model\Game;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class GamesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/games",
     *     tags={"games"},
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="Game name",
     *     required=false,
     * ),
     *     @OA\Response(response="200", description="Returns game list for featured games section on homepage")
     * )
     */
    public function getGameList(Request $request)
    {
        $query = Game::query()->withCount('tournaments');
        $name = $request->input('name');
        if ($name) {
            $query->where('name', 'LIKE', '%'.$name.'%');
        }

        return $this->successApiResponse($query->get());
    }

    /**
     * @OA\Get(
     *     path="/api/games/{game}",
     *     tags={"games"},
     * @OA\Parameter(
     *     name="game",
     *     in="path",
     *     description="Game id",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Returns game")
     * )
     */
    public function show(Game $game)
    {
        return $this->successApiResponse($game);
    }

    public static function testingAPI(Request $request)
    {
        // if (!$request->file($name)) {
        //     return;
        // }
        $imagePath = 'games/'.time().'.'.$request->file->getClientOriginalExtension();
        $image = Image::make($request->file);
        if (Storage::disk('s3')->put($imagePath, $image->stream())) {
            return $imagePath;
        }

        return false;
    }
}
