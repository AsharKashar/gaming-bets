<?php

namespace App\Http\Controllers;

use App\Model\Team;
use App\Model\TeamInvite;
use Exception as ExceptionAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamInviteController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/team/{team_invite}/invite",
     *     tags={"team_invite"},
     * @OA\Parameter(
     *     name="team_invite",
     *     in="path",
     *     description="Team id",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Remove invite member"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     * @param  TeamInvite  $teamInvite
     * @return JsonResponse
     * @throws ExceptionAlias
     */
    public function deleteInvite(TeamInvite $teamInvite)
    {
        $teamInvite->delete();
        return $this->successApiResponse();
    }
}
