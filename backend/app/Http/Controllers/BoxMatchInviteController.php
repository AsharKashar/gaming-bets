<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Model\BoxMatchInvite;

class BoxMatchInviteController extends Controller
{
    //

    public function check(request $request)
    {
        $invite = BoxMatchInvite::where('token', $request->token)->first();
        return $invite;
    }

    /**
     * @OA\Get(
     *     path="/api/box-matches/boxfights-invite-links/{id}",
     *     tags={"box-matches"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Box Match ID",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get the invitation links for a box fight")
     * )
     */

    public function getInviteLinks($id)
    {
        $invite_link = [];
        $invites = BoxMatchInvite::where('match_id', $id)->get();
        foreach ($invites as $key => $invite) {
            if ($invite->team_id == 1) {
                $invite_link['same_team'] = url(
                        '/'
                    )."/join-match?token=".$invite->token."&match_id=".$invite->match_id;
            } else {
                $invite_link['team '.$invite->team_id] = url(
                        '/'
                    )."/join-match?token=".$invite->token."&match_id=".$invite->match_id;
            }
        }
        return response()->json($invite_link);
    }
}
