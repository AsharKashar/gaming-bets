<?php

namespace App\Http\Controllers;

use App\Model\BombHistory;
use App\Service\S3Service;
use App\Model\BoxMatches;
use App\Model\BoxMatchInvite;
use App\Model\BoxMatchResult;
use App\Model\BoxmatchUser;
use App\Model\Game;
use App\Model\GamePlatform;
use App\Model\GameTypeBoxmatch;
use App\Model\Region;
use App\Model\User;
use App\Service\BombsPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class BoxMatchesController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/box-matches/view-boxfights-user",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="Logged In Users ID (leave empty to check for no user logged In (Temporary) )",
     * ),
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     required=true,
     *     description="Game ID of the game for which you want to view box fights of",
     * ),
     * @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     required=true,
     *     description="Number of box fights visible on every page",
     * ),
     *     @OA\Response(response="200", description="View Box Fights for from perspective of a user ( remark variable of each match identifies the state of user in that particular match")
     * )
     */
    public function boxfights(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'game_id' => ['required', 'numeric'],
                'per_page' => ['required', 'numeric'],
            ]
        );
        if (!Game::find($request->game_id)) {
            return response()->json(['error' => 'Game does not exist.'], 400);
        }

        if ($request->id) {
            return response()->json(BoxMatches::viewBoxfights($request->id, $request->game_id, $request->per_page));
        }
        return [
            'Active Matches' => BoxMatches::notLoggedIn($request->game_id, $request->per_page),
            'Cancelled Matches' => []
        ];
    }

    /**
     * @OA\Post(
     *     path="/api/box-matches/view-boxfight-history-with-remark/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Logged In Users ID",
     * ),
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     required=true,
     *     description="Game ID of the game for which you want to view box fights history of",
     * ),
     *     @OA\Response(response="200", description="View Box Fights History from perspective of a user ( remark variable of each match identifies the result of user in that particular match )"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */

    public function viewBoxFightHistoryRemark(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'game_id' => ['required', 'numeric'],
            ]
        );
        $user = Auth::user();
        $id = $user->id;
        if (!User::find($id)) {
            return response()->json(['error' => 'User does not exist.'], 400);
        }
        return response()->json(BoxMatches::viewBoxfightsHistory($id, $request->game_id));
    }

    /**
     * @OA\Put(
     *     path="/api/box-matches/create",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     description="User Id",
     * ),
     * @OA\Parameter(
     *     name="boxmatch_name",
     *     in="query",
     *     required=true,
     *     description="Assign a name to your box fight",
     * ),
     * @OA\Parameter(
     *     name="date",
     *     in="query",
     *     required=true,
     *     description="Starting Date in timestamp format Y-m-d",
     * ),
     * @OA\Parameter(
     *     name="time",
     *     in="query",
     *     required=true,
     *     description="Starting Time in timestamp format H:i",
     * ),
     * @OA\Parameter(
     *     name="bid_amount",
     *     in="query",
     *     required=true,
     *     description="Amount that is being wagered",
     * ),
     * @OA\Parameter(
     *     name="game_type_boxmatch_id",
     *     in="query",
     *     required=true,
     *     description="game type of box match ID from table (game_type_boxmatch) (Enter 1 for 1v1, 2 for 2v2)",
     * ),
     * @OA\Parameter(
     *     name="platform_id",
     *     in="query",
     *     required=true,
     *     description="ID of platform from game_plateform (1 for Xbox, 2 for Playstation etc)",
     * ),
     * @OA\Parameter(
     *     name="region_id",
     *     in="query",
     *     required=true,
     *     description="region ID from the region table",
     * ),
     * @OA\Parameter(
     *     name="username",
     *     in="query",
     *     required=true,
     *     description="Epic game username",
     * ),
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     required=true,
     *     description="Game ID from the games table",
     * ),
     *     @OA\Response(response="200", description="Create a new box fight, in response box match invitation links will be returned."),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function create(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'boxmatch_name' => ['required'],
                'username' => ['required'],
                'date' => ['required', 'date_format:Y-m-d'],
                'time' => ['required', 'date_format:H:i'],
                'bid_amount' => ['required', 'numeric'],
                'game_type_boxmatch_id' => ['required', 'numeric'],
                'platform_id' => ['required', 'numeric'],
                'region_id' => ['required', 'numeric'],
                'game_id' => ['required', 'numeric']


            ]
        );
        $user = Auth::user();
        if (!User::find($user->id)) {
            return response()->json(['error' => 'User does not exist.'], 400);
        }
        if (!Game::find($request->game_id)) {
            return response()->json(['error' => 'Game does not exist.'], 400);
        }
        if (!Region::find($request->region_id)) {
            return response()->json(['error' => 'Region does not exist.'], 400);
        }
        if (!GamePlatform::find($request->platform_id)) {
            return response()->json(['error' => 'Platform does not exist.'], 400);
        }
        if (!GameTypeBoxmatch::find($request->game_type_boxmatch_id)) {
            return response()->json(['error' => 'Invalid game type.'], 400);
        }
        $new_time = Carbon::createFromFormat('Y-m-d H:i', $request->date.' '.$request->time);
        $timeDifferenceFromPresent = $new_time->diffInMinutes(Carbon::now(), false);
        if ($timeDifferenceFromPresent >= -5) {
            return response()->json(['error' => 'There should be atleast 5 minute difference from now.'], 400);
        }
        $participations = BoxmatchUser::where('user_id', $user->id)->get();
        foreach ($participations as $existing_match) {
            $boxmatch = BoxMatches::find($existing_match->match_id);
            if ($boxmatch->status == BoxMatches::MATCH_IS_LIVE || $boxmatch->status == BoxMatches::MATCH_HAS_ENDED) {
                return response()->json(['error' => 'You currently have a live match.'], 400);
            } else {
                if ($boxmatch->status == BoxMatches::MATCH_JOINING_IN_PROGRESS || $boxmatch->status == BoxMatches::MATCH_IS_FULL) {
                    $existing_time = Carbon::parse($boxmatch->time);
                    $timeDifference = $new_time->diffInMinutes($existing_time);
                    if ($timeDifference < 90) {
                        return response()->json(['error' => 'You have joined another match closed to that time.'], 400);
                    }
                }
            }
        }


        if (!BoxMatches::checkFreeFights($user->id)) {
            return response()->json(['error' => 'No more free box fights remain.'], 400);
        }

        if (!$request->bid_amount) {
            return response()->json(['error' => 'Bid amount can not be 0.'], 400);
        }

        $hasBombs = BombsPayment::checkIfUserHasBombs(
                $user,
                $request->bid_amount,
            );
        if(!$hasBombs){
            return response()->json(['error' => 'Not enough bomb in your account.'], 400);
        }

        $data = new BoxMatches();
        $data->boxmatch_name = $request->boxmatch_name;
        $data->bid_amount = $request->bid_amount;
        $data->game_type_boxmatch_id = $request->game_type_boxmatch_id;
        $data->platform_id = $request->platform_id;
        $data->region_id = $request->region_id;
        $timestamp = $new_time;
        $data->time = $timestamp;
        $data->game_id = $request->game_id;
        $data->status = BoxMatches::MATCH_JOINING_IN_PROGRESS;
        $data->save();

        BombsPayment::userPayBombs(
            $user,
            $request->bid_amount,
            BombHistory::TYPES['boxMatch'],
            $data->id
        );

        $data2 = new BoxmatchUser();
        $data2->match_id = $data->id;
        $data2->user_id = $user->id;
        $data2->username = $request->username;
        $data2->team_id = 1;
        $data2->is_host = 1;
        $data2->save();




        $i = BoxMatches::TEAMS_ALLOWED;
        for ($i; $i > 0; $i--) {
            if (GameTypeBoxmatch::find($request->game_type_boxmatch_id)->value == BoxMatches::ONE_VS_ONE && $i == 1) {
                break;
            }
            $invite = new BoxMatchInvite();
            $token = Hash::make(Carbon::now().$data->id.$user->id.$i);
            $invite->match_id = $data->id;
            $invite->team_id = $i;
            $invite->token = $token;
            $invite->save();
            if ($i == '1') {
                if (GameTypeBoxmatch::find($request->game_type_boxmatch_id)->value != BoxMatches::ONE_VS_ONE) {
                    $invite_link['same_team'] = url('/')."/join-match?token=".$token."&match_id=".$data->id;
                }
            } else {
                $invite_link['team '.$i] = url('/')."/join-match?token=".$token."&match_id=".$data->id;
            }
        }

        return response()->json($invite_link);
    }


    /**
     * @OA\Post(
     *     path="/api/box-matches/join-using-link/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="user ID",
     * ),
     * @OA\Parameter(
     *     name="username",
     *     in="query",
     *     description="Username for the box fight",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="invite_token",
     *     in="query",
     *     description="Token obtained from the invite link",
     * ),
     *     @OA\Response(response="200", description="Join box fight using an invite link"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function join(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'username' => ['required'],
                // 'token' => ['required'],
            ]
        );
        $user = Auth::user();
        $id = $user->id;
        if (!User::find($id)) {
            return response()->json(['error' => 'User does not exist.'], 400);
        }
        if ($request->invite_token) {
            $invite = BoxMatchInvite::where('token', $request->invite_token)->first();
            if (!$invite) {
                return response()->json(['error' => 'Link not active.'], 400);
            }
            $assigned_team = $invite->team_id;
            $data_i = BoxMatches::find($invite->match_id);
            if (!$data_i) {
                return response()->json(
                    [
                        'message' => 'match not found'
                    ],
                    400
                );
            }
        } else {
            $assigned_team = $request->team_id;
            $data_i = BoxMatches::find($request->match_id);
            if (!$data_i) {
                return response()->json(
                    [
                        'message' => 'match not found'
                    ],
                    400
                );
            }
        }

        if (BoxMatches::checkIfUserAlreadyJoined($data_i->id, $id)) {
            return response()->json(['error' => 'User Already part of this match.'], 400);
        }
        if ($data_i->status != BoxMatches::MATCH_JOINING_IN_PROGRESS) {
            return response()->json(['error' => 'Match joining not in progress.'], 400);
        }

        $data_for_cancel = BoxMatches::where('status', BoxMatches::MATCH_JOINING_IN_PROGRESS)->get();
        foreach ($data_for_cancel as $data_cancel) {
            $check_current_time = Carbon::parse($data_cancel->time);
            $time_check_min = $check_current_time->diffInMinutes(now(), false);
            if ($time_check_min >= 0) {
                $childUser = BoxmatchUser::where('match_id', $data_cancel->id)->get();
                $data_cancel->status = BoxMatches::MATCH_CANCELLED;
                $data_cancel->save();
                  BoxMatches::cancelNotification($data_cancel, $data_cancel->bid_amount, BoxMatches::$REASON_CANCELLATION['not_enough_user']);
                foreach ($childUser as $child) {
                    BombsPayment::RefundUser(
                        $child->user_id,
                        BombHistory::TYPES['boxMatch'],
                        $child->match_id
                    );
                    // THE REFACTORING
                    // $refund = new User1Awards();
                    // $refund->user_id = $child->user_id;
                    // $refund->bomb = $data_cancel->bid_amount;
                    // $refund->save();
                }
            }
        }
        if ($request->invite_token) {
            $checkAgain = BoxMatches::find($invite->match_id);
        } else {
            $checkAgain = BoxMatches::find($request->match_id);
        }
        if ($checkAgain->status == BoxMatches::MATCH_CANCELLED) {
            return response()->json(['error' => 'Match has been cancelled.'], 400);
        }

        $participations = BoxmatchUser::where('user_id', $id)->get();
        foreach ($participations as $existing_match) {
            $boxmatch = BoxMatches::find($existing_match->match_id);
            if ($boxmatch->status == BoxMatches::MATCH_IS_LIVE || $boxmatch->status == BoxMatches::MATCH_HAS_ENDED) {
                return response()->json(['error' => 'You currently have an active match.'], 400);
            } else {
                if ($boxmatch->status == BoxMatches::MATCH_JOINING_IN_PROGRESS || $boxmatch->status == BoxMatches::MATCH_IS_FULL) {
                    $new_time = Carbon::parse($data_i->time);
                    $existing_time = Carbon::parse($boxmatch->time);
                    $timeDifference = $new_time->diffInMinutes($existing_time);
                    if ($timeDifference < 90) {
                        return response()->json(['error' => 'You have joined another match closed to that time.'], 400);
                    }
                }
            }
        }

        $hasBombs = BombsPayment::checkIfUserHasBombs(
            $user,
            $data_i->bid_amount,
        );
        if(!$hasBombs){
            return response()->json(['error' => 'Not enough bomb in your account.'], 400);
        } else {
            if ($hasBombs) {
                $data = new BoxmatchUser();
                $data->match_id = $data_i->id;
                $data->user_id = $id;
                $data->team_id = $assigned_team;
                $data->username = $request->username;
                $data->save();

                BombsPayment::userPayBombs(
                    $user,
                    $data_i->bid_amount,
                    BombHistory::TYPES['boxMatch'],
                    $data_i->id
                );

                $checkteam1 = BoxmatchUser::where('match_id', $data_i->id)->where('team_id', '1')->get();
                $checkteam2 = BoxmatchUser::where('match_id', $data_i->id)->where('team_id', '2')->get();
                if (GameTypeBoxmatch::find($data_i->game_type_boxmatch_id)->value == count(
                        $checkteam1
                    ) && GameTypeBoxmatch::find($data_i->game_type_boxmatch_id)->value == count($checkteam2)) {
                    $get = BoxMatches::find($data_i->id);
                    $get->status = BoxMatches::MATCH_IS_FULL;
                    $get->save();
                }
            }
        }

        BoxMatchInvite::deleteIfMatchFull($data_i->id);
        BoxMatches::joinNotification($assigned_team, $data_i, $id);
        return response()->json(
            [
                'success' => true,
                'message' => 'Match joined Successfully '
            ]
        );
    }

    /**
     * @OA\Post(
     *     path="/api/box-matches/join-using-button/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     description="User ID",
     * ),
     * @OA\Parameter(
     *     name="username",
     *     in="query",
     *     description="Username for the box fight",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Join box fight using the join button"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function joinButton(request $request, $id)
    {
        $data_i = BoxMatches::find($id);
        if (!$data_i) {
            return response()->json(['error' => 'Box fight does not exist.'], 400);
        }
        $user = Auth::user();
        if (!User::find($user->id)) {
            return response()->json(['error' => 'User does not exist.'], 400);
        }
        $checkteam1 = BoxmatchUser::where('match_id', $id)->where('team_id', '1')->get();
        $request->team_id = count($checkteam1) < GameTypeBoxmatch::find($data_i->game_type_boxmatch_id)->value ? 1 : 2;
        $request->match_id = $id;

        return $this->join($request, $user->id);
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/view-boxfights",
     *     tags={"box-matches"},
     *     @OA\Response(response="200", description="View all box fights")
     * )
     */
    public function view()
    {
        $boxMatches = BoxMatches::with('region')->with('platform')->with('gameTypeBoxmatch')->with('game')->get();
        foreach ($boxMatches as $key => $boxMatch) {
            $boxMatchUser = BoxmatchUser::where('match_id', $boxMatch->id)->where('is_host', '1')->first();
            $boxMatches[$key]['user'] = User::find($boxMatchUser->user_id);
        }
        return response()->json($boxMatches);
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/view-boxfight/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="View a box fight")
     * )
     */
    public function viewBoxFight($id)
    {
        $boxMatch = BoxMatches::where('id', $id)->with('region')->with('platform')->with('gameTypeBoxmatch')->with(
            'game'
        )->first();
        $boxMatchUser = BoxmatchUser::where('match_id', $boxMatch->id)->where('is_host', '1')->first();
        $boxMatch['user'] = User::find($boxMatchUser->user_id);

        return response()->json($boxMatch);
    }

    /**
     * @OA\Post(
     *     path="/api/box-matches/view-boxfight-with-remark/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     description="User ID ",
     * ),
     *     @OA\Response(response="200", description="View a box fight with the remarks"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function viewBoxFightRemark(request $request, $id)
    {
        $user = Auth::user();
        if ($user->id) {
            if (!User::find($user->id)) {
                return response()->json(['error' => 'User does not exist.'], 400);
            }

            $parentMatch = BoxMatches::where('id', $id)->with('region')->with('platform')->with(
                'gameTypeBoxmatch'
            )->with('game')->first();
            if (!$parentMatch) {
                return response()->json(['error' => 'Match does not exist.'], 400);
            }
            $boxmatchUser = BoxmatchUser::where('match_id', $parentMatch->id)->where('is_host', '1')->first();
            $parentMatch['user'] = User::find($boxmatchUser->user_id);

            $childMatches = BoxmatchUser::where('match_id', $id)->where('user_id', $user->id)->first();
            if (!$childMatches) {
                if ($parentMatch->status == BoxMatches::MATCH_JOINING_IN_PROGRESS) {
                    $parentMatch['remarks'] = 'Open for joining';
                } else {
                    if ($parentMatch->status == BoxMatches::MATCH_IS_FULL) {
                        $parentMatch['remarks'] = 'full';
                    } else {
                        $parentMatch['remarks'] = 'Not available';
                    }
                }
                return $parentMatch;
            }

            $parentMatch = BoxMatches::setRemarks($parentMatch, $childMatches);

            return response()->json($parentMatch);
        } else {
            $parentMatch = BoxMatches::where('id', $id)->with('region')->with('platform')->with(
                'gameTypeBoxmatch'
            )->with('game')->first();//WIP
            if ($parentMatch) {
                $parentMatch['remarks'] = 'User not logged In';
            }
            $boxmatchUser = BoxmatchUser::where('match_id', $parentMatch->id)->where('is_host', '1')->first();
            $parentMatch['user'] = User::find($boxmatchUser->user_id);

            return response()->json($parentMatch);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/view-boxfight-team/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="View teams that are part of boxfight")
     * )
     */
    public function viewBoxFightTeam($id)
    {
        $data['team1'] = BoxmatchUser::where('match_id', $id)->where('team_id', '1')->with('user')->get();
        $data['team2'] = BoxmatchUser::where('match_id', $id)->where('team_id', '2')->with('user')->get();

        return response()->json($data);
    }

    /**
     * @OA\Post(
     *     path="/api/box-matches/if-user-exists/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Match id",
     * ),
     * @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     description="User ID",
     * ),
     *     @OA\Response(response="200", description="If user exists in the match"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function ifUserExists(request $request, $id)
    {
        $user = Auth::user();
        if (!User::find($user->id)) {
            return response()->json(['error' => 'User does not exist.'], 400);
        }

        $data = BoxmatchUser::where('match_id', $id)->where('user_id', $user->id)->first();
        if ($data) {
            return response()->json(
                [
                    'status' => 'success',
                    'result' => 'true',
                    'message' => 'User already exists'
                ]
            );
        }


        return response()->json(
            [
                'status' => 'success',
                'result' => 'false',
                'message' => 'User does not exists'
            ]
        );
    }

    /**
     * @OA\Post(
     *     path="/api/box-matches/check-if-team-full/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     * ),
     * @OA\Parameter(
     *     name="team_id",
     *     in="query",
     *     description="Team ID (either 1 or 2)",
     * ),
     *     @OA\Response(response="200", description="Check if team of a box match is full")
     * )
     */
    public function checkIfTeamFull(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'team_id' => ['required'],
            ]
        );
        $check = BoxMatches::find($id);
        if (!$check) {
            return response()->json(
                [
                    'message' => 'match not found'
                ],
                400
            );
        }

        $boxMatchesCount = BoxmatchUser::where('match_id', $id)->where('team_id', $request->team_id)->get()->count();
        $compare_value = GameTypeBoxmatch::find($check->game_type_boxmatch_id);
        if (!$compare_value) {
            return response()->json(
                [
                    'message' => 'Missing game type for this box fight'
                ],
                400
            );
        }
        if ($boxMatchesCount < $compare_value->value) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Spot Available'
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Match is full'
                ]
            );
        }
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/end-live-match/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="End a LIVE box match"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function endLiveMatch($id)
    {
        $statusCheck = BoxMatches::find($id);
        if ($statusCheck->status != BoxMatches::MATCH_IS_LIVE) {
            return response()->json(['message' => 'MATCH ALREADY END'], 200);
        }

        $match = BoxMatches::find($id);
        $match->status = BoxMatches::MATCH_HAS_ENDED;
        $match->matchEnd_time = Carbon::now();
        $match->save();

        BoxMatches::endNotification($match);

        return response()->json(['message' => 'Match has ended']);
    }

    /**
     * @OA\Post(
     *     path="/api/box-matches/status-update/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     * ),
     * @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     description="Logged In User ID",
     * ),
     * @OA\Parameter(
     *     name="result",
     *     in="query",
     *     description="('won' or 'lost') result of the match",
     * ),
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     description="This is game ID",
     * ),
     *     @OA\Response(response="200", description="User set result for the match and decision is made if all the user have added the results"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function statusUpdate(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'result' => ['required'],
                'game_id' => ['required'],
            ]
        );
        $user = Auth::user();
        if (!User::find($user->id)) {
            return response()->json(['error' => 'User does not exist.'], 400);
        }
        if (!Game::find($request->game_id)) {
            return response()->json(['error' => 'Game does not exist.'], 400);
        }
        if ($request->result != 'won' && $request->result != 'lost') {
            return response()->json(['error' => 'Invalid result.'], 400);
        }
        $statusCheck = BoxMatches::find($id);
        if ($statusCheck->status != BoxMatches::MATCH_HAS_ENDED) {
            return response()->json(['error' => 'Match is not ended.'], 400);
        }

        $data = BoxmatchUser::where('match_id', $id)->where('user_id', $user->id)->first();

        $data->result = $request->result;
        $data->save();


        if (!BoxMatches::ifMatchHaveResult($id)) {
            BoxMatches::extractResult($id);
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Status changed and result extracted',
                ]
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Status changed',
            ]
        );
    }

    /**
     * @OA\Post(
     *     path="/api/box-matches/upload-evidence/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     * ),
     * @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     description="Logged In User ID",
     * ),
    *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             description="Upload Image",
     *                             property="file",
     *                             type="string", format="binary"
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="User uploads evidence"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function uploadEvidence(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'file' => ['required'],
            ]
        );

        $user = Auth::user();
        if (!User::find($user->id)) {
            return response()->json(['error' => 'User does not exist.'], 400);
        }

        $match = BoxMatches::find($id);
        if (!$match) {
            return response()->json(['error' => 'Box fight does not exist.'], 400);
        }
        $userMatch = BoxmatchUser::where('match_id', $id)->where('user_id', $user->id)->first();
        if (!$userMatch) {
            return response()->json(['error' => 'User not part of this box fight.'], 400);
        }

        $data_img = [];
        $data_vid = [];

        $statusCheck = BoxMatches::find($id);
        if ($statusCheck->status != BoxMatches::MATCH_HAS_ENDED) {
            return response()->json(['error' => 'Match is not ended.'], 400);
        }

        foreach ($request->file as $key => $fa) {
            if (in_array(
                $fa->getClientMimeType(),
                [

                    'image/jpeg',
                    'image/png',
                    // 'application/octet-stream',
                ]
            )) {
                if ($path = S3Service::uploadFile('evidence', $fa, $user->id)) {
                    $prefix = config('services.awsurl.url');
                    $data_img[$key] = $prefix.$path;
                }
            } else {
                if (
                in_array(
                    $fa->getClientMimeType(),
                    [
                        'video/mp4',
                        'video/x-flv',
                        'video/x-matroska',


                    ]
                )) {
                    if ($path = S3Service::uploadFile('evidence', $fa, $user->id)) {
                        $prefix = config('services.awsurl.url');
                        $data_vid[$key] = $prefix.$path;
                    }
                } else {
                    return response()->json(
                        ['error' => 'Wrong File Format. (only jpeg, png, mp4, flv or mkv files allowed)'],
                        400
                    );
                }
            }
        }

        $data = BoxmatchUser::where('match_id', $id)->where('user_id', $user->id)->first();
        $data->proof_image = json_encode($data_img);
        $data->proof_video = json_encode($data_vid);
        $data->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Files Uploaded'
            ]
        );
    }


    public function uploadEvidenceVideo(request $request, $id)//Ignore
    {
        $this->validate(
            $request->all(),
            [
                'file' => ['required'],
                'user_id' => ['required', 'numeric'],
            ]
        );
        $data_vid = [];

        // $statusCheck = BoxMatches::find($id);
        // if ($statusCheck->status != BoxMatches::MATCH_HAS_ENDED) {
        //     return response()->json(['error' => 'Match is not ended.'], 400);
        // }

        foreach ($request->file as $key => $fa) {
            if (
            in_array(
                $fa->getClientMimeType(),
                [
                    'video/mp4',

                ]
            )) {
                if ($path = S3Service::uploadFile('evidence', $fa, $request->user_id)) {
                    $prefix = config('services.awsurl.url');
                    $data_vid[$key] = $prefix.$path;
                }
            } else {
                return response()->json(['error' => 'Wrong File Format.'], 400);
            }
        }
        $data = BoxMatches::where('match_id', $id)->where('user_id', $request->user_id)->first();
        $data->proof_video = json_encode($data_vid);
        $data->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Videos Uploaded'
            ]
        );
    }

    /**
     * @OA\Post(
     *     path="/api/box-matches/get-team-evidence/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="team_id",
     *     in="query",
     *     description="Team ID (1 or 2)",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get Evidence for team 1 or team 2")
     * )
     */
    public function getEvidenceteam(request $request, $id)
    {
        return response()->json(
            BoxmatchUser::where('match_id', $id)->where('team_id', $request->team_id)->get(
                ['match_id', 'user_id', 'proof_image', 'proof_video']
            )
        );
    }


    public function deleteMatchAdmin($id)
    {
        if (!BoxMatches::find($id)) {
            return response()->json(
                [
                    'message' => 'Not found'
                ],
                400
            );
        }

        BoxMatches::deleteMatch($id);

        return response()->json(
            [
                'success' => true,
                'message' => 'Box Fight deleted'
            ]
        );
    }


    /**
     * @OA\Get(
     *     path="/api/box-matches/get-deleted-matches",
     *     tags={"box-matches"},
     *     @OA\Response(response="200", description="Get all deleted Box Matches")
     * )
     */

    public function getDeletedMatches()
    {
        return response()->json(BoxMatches::onlyTrashed()->get());
    }


    public function adminResult(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'winner' => ['required', 'numeric'],
            ]
        );
        if ($request->winner != 1 && $request->winner != 2) {
            return response()->json(
                [
                    'message' => 'Invalid Winner',
                ],
                400
            );
        }
        $data = BoxMatches::find($id);
        $teamMembers = BoxmatchUser::where('match_id', $id)->get();
        $award = $data->bid_amount * 2;
        if ($request->winner == BoxMatches::WINNER_TEAM1) {
            foreach ($teamMembers as $teamMember) {
                if ($teamMember->team_id == 1) {
                    BoxMatches::teamMemberWon($teamMember, $award, $data);
                }
                if ($teamMember->team_id == 2) {
                    BoxMatches::teamMemberLost($teamMember, $data);
                }
            }
        }
        if ($request->winner == BoxMatches::WINNER_TEAM2) {
            foreach ($teamMembers as $teamMember) {
                if ($teamMember->team_id == 2) {
                    BoxMatches::teamMemberWon($teamMember, $award, $data);
                }
                if ($teamMember->team_id == 1) {
                    BoxMatches::teamMemberLost($teamMember, $data);
                }
            }
        }
        if ($request->winner == BoxMatches::WINNER_CANCELLED) {
            foreach ($teamMembers as $teamMember) {
                BoxMatches::matchCancelledRefundAwards($teamMember, $award, $data);
            }
        }

        return response()->json(
            [
                'success' => true
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/boxfights-ladder/{gameid}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="gameid",
     *     in="path",
     *     description="This is featured game ID ( 1 for fortnite, 2 for call of duty, 3 for CS GO)",
     * ),
     *     @OA\Response(response="200", description="Get box fight ladder for a particular game")
     * )
     */


    public function getBoxFightLadder($gameid)
    {
        if (!Game::checkGames($gameid)) {
            return response()->json(
                [
                    'message' => 'Game Does not exists',
                ],
                400
            );
        }

        $users = User::where('user_type', 'user')->get();
        $data = BoxMatchResult::getBoxFightLadder($users, $gameid);
        $data = collect($data);

        $data = $data->sortByDesc('winnings');
        // $sorted = $data->sortByDesc(function ($item, $key) {
        //     return $item['winnings'];
        // });
        $data = $data->all();

        return response()->json($data);
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/get-game-platforms/{game_id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="game_id",
     *     in="path",
     *     description="This is game ID from games table",
     * ),
     *     @OA\Response(response="200", description="Get Platform available for a game")
     * )
     */

    public function getPlatformBoxFight($game_id)
    {
        $data = Game::find($game_id);
        if (!$data) {
            return response()->json(
                [
                    'message' => 'Game does not exist',
                ],
                400
            );
        }
        return $data->gamePlatforms;
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/get-game-regions",
     *     tags={"box-matches"},
     *     @OA\Response(response="200", description="Get available Regions")
     * )
     */

    public function getRegionBoxFight()
    {
        $data = Region::all();
        return $data;
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/assign-boxfights/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the user, to whom you want to assign box fights",
     * ),
     *     @OA\Response(response="200", description="add 10 box fights to a user for testing purpose only")
     * )
     */

    public function assignFight($id)
    {
        $user = User::find($id);
        $user->boxfights_allowed = 10;
        $user->save();
        return response()->json(
            [
                'success' => true,
                'message' => '10 box fights allocatied'
            ]
        );
    }

    public function test()
    {
        return 'Test';
    }

}
