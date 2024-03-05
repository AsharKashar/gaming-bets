<?php

namespace App\Http\Controllers;

use App\Model\Game;
use App\Model\GameMode;
use App\Model\GameType;
use App\Model\Leaderboard;
use App\Model\Tournament;
use App\Model\UserPoint;
use App\Model\User;
use Illuminate\Http\Request;

class LeaderBoardController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/leaderboard/get-gameleaderboard",
     *     tags={"leaderboard"},
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     description="Game ID from games table",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="game_mode_id",
     *     in="query",
     *     description="Game Mode ID from game mode table",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="game_type_id",
     *     in="query",
     *     description="game type ID from the game type table",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get leaderboard for a particular game type")
     * )
     */
    public function getLeaderboard(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'game_mode_id' => ['required'],
                'game_type_id' => ['required'],
            ]
        );
        if (!GameType::checkTheGameTypeValue($request->game_type_id)) {
            return response()->json(['error' => 'Invalid Game Type ID.'], 400);
        }

        if (!GameMode::checkTheGameModeValue($request->game_mode_id)) {
            return response()->json(['error' => 'Invalid Game Mode ID.'], 400);
        }

        // if (!Game::checkGames($request->game_id)) {
        //     return response()->json(['error' => 'Invalid Game ID.'], 400);
        // }

        // $dataSet = GameMode::find($request->game_mode_id);

        $matches = Tournament::getGameWithMode($request->game_mode_id, $request->game_type_id);
        $users = User::where('user_type', 'user')->get();
        $usersWithResults = UserPoint::getUsersPointsWinnings($users, $matches);
        $returnData = User::sortUsers($usersWithResults);

        return response()->json($returnData);
    }

    /**
     * @OA\Post(
     *     path="/api/leaderboard/get-game-topthree",
     *     tags={"leaderboard"},
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     description="Game ID from games table",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get leaderboard for a particular Game")
     * )
     */
    public function getGameTopThree(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'game_id' => ['required'],
            ]
        );

        if (!Game::checkGames($request->game_id)) {
            return response()->json(['error' => 'Invalid Game ID.'], 400);
        }
        $matches = Tournament::getallgames($request->game_id);
        $users = User::where('user_type', 'user')->get();
        $usersWithResults = UserPoint::getUsersPointsWinningsAll($users, $matches, $request->game_id);

        $returnData = User::selectTopThree($usersWithResults);

        return response()->json($returnData);
    }

    /**
     * @OA\Get(
     *     path="/api/leaderboard/monthly-top-player",
     *     tags={"leaderboard"},
     *     @OA\Response(response="200", description="This Months Top Three Players")
     * )
     */
    public function getTopThreeOfMonth()
    {
        $data = Leaderboard::with('user.level')->get();
        return response()->json($data);
    }

    /**
     * @OA\Get(
     *     path="/api/leaderboard/get-history-top-monthly",
     *     tags={"leaderboard"},
     *     @OA\Response(response="200", description="Get History of Monthly Top Three Players")
     * )
     */

    public function getDeletedTopThreeOfMonth()
    {
        $data = Leaderboard::onlyTrashed()->with('user')->get();
        return response()->json($data);
    }
}
