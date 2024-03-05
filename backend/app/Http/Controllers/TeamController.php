<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Model\User;
use App\Relations\TeamUserRelation;
use App\Model\Team;
use App\Model\TeamInvite;
use App\Service\S3Service;
use App\Service\TournamentTeamsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TeamController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/team",
     *     tags={"team"},
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="Team name",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="team_size_id",
     *     in="query",
     *     description="Team size id",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     description="Related game is",
     *     required=true,
     * ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             description="Item image",
     *                             property="avatar",
     *                             type="string", format="binary"
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Create team"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     * @param  TeamRequest  $request
     * @return JsonResponse
     */
    public function create(TeamRequest $request)
    {

        $team = Team::createNewTeam([
            'name' => $request->name,
            'team_size_id' => $request->team_size_id,
            'game_id' => $request->game_id,
        ]);

        if ($avatar = $request->file('avatar')) {
            $path = S3Service::uploadToDirectory($avatar, "teams/$team->team_id");
            $team->avatar_key = $path;
            $team->save();
        }

        $team->addMember(auth()->user(), ['is_leader' => true, 'checked_in' => true]);
        if ($invitedEmails = json_decode($request->input('members'))) {
            if (TournamentTeamsService::limitTeam($team, count($invitedEmails))) {
                return $this->internalErrorApiResponse([], 'Team limit exceeded');
            }
            foreach ($invitedEmails as $invitedEmail) {
                $this->createTeamInvitation($invitedEmail, $team);
            }
        }

        return $this->successApiResponse($team);
    }

    /**
     * @OA\Get(
     *     path="/api/team",
     *     tags={"team"},
     * @OA\Parameter(
     *     name="per_page",
     *     in="path",
     *     description="Posts per page default(10)",
     *     required=false,
     * ),
     *     @OA\Response(response="200", description="List users of team"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function list(Request $request)
    {
        $perPage = $request->input('per_page') ?? 10;
        $teamSizeId = $request->input('team_size_id');
        $gameId = $request->input('game_id');

        $query = Team::forCurrentUser()->with(
            [
                'sizes',
                'members',
            ]
        )->with(
            [
                'invitations' => function ($query) {
                    $query->where('status', TeamInvite::STATUS_INVITE['invited']);
                }
            ]
        );

//        $query = Team::query();
//        $query:->ForCurrentUser()->with(['members', 'invitations']);
        if ($teamSizeId) {
            $query->where('team_size_id', $teamSizeId);
        }

        if ($gameId) {
            $query->where('game_id', $gameId);
        }

        return $this->successApiResponse($query->paginate($perPage));
    }

    /**
     * @OA\Post(
     *     path="/api/team/{team_id}/invite",
     *     tags={"team"},
     * @OA\Parameter(
     *     name="team_id",
     *     in="path",
     *     description="Team id",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="User email",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Invite a new member to team"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     * @param  Request  $request
     * @param  Team  $team
     * @return JsonResponse
     */
    public function invite(Request $request, Team $team)
    {
        $email = $request->input('email');

        if ($team) {
            if (TournamentTeamsService::limitTeam($team)) {
                return $this->internalErrorApiResponse([], 'Team limit exceeded');
            }
            $this->createTeamInvitation($email, $team);

            return $this->successApiResponse();
        }

        return $this->resourceNotFound();
    }

    public function teamRelation(Request $request)
    {
        return $this->successApiResponse(TeamUserRelation::create($request->all()));
    }

    /**
     * @OA\Delete(
     *     path="/api/team/user",
     *     tags={"team"},
     * @OA\Parameter(
     *     name="team_id",
     *     in="query",
     *     description="Team id",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     description="Team id",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Delete team member"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     * @param  Request  $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteUser(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'user_id' => ['required', 'numeric'],
                'team_id' => ['required', 'numeric']
            ]
        );

        $member = TeamUserRelation::where('user_id', $request->user_id)
            ->where('team_id', $request->team_id)->first();


        if (!$member) {
            return $this->resourceNotFound();
        }

        $member->delete();

        return $this->successApiResponse();
    }

    /**
     * @OA\Post(
     *     path="/api/team/join/team-token",
     *     tags={"team"},
     * @OA\Parameter(
     *     name="team_token",
     *     in="query",
     *     description="Team token",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Join to team by team token"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     * @param  Request  $request
     * @return JsonResponse
     */
    public function joinTeamByTeamToken(Request $request)
    {
        $token = $request->input('team_token');
        $user = auth()->user();
        $team = Team::firstWhere('token', $token);
        $teamInvite = TeamInvite::firstWhere([
            'email' => optional($user)->email, 'team_id' => optional($team)->team_id
        ]);
        if (!$teamInvite) {
            return $this->resourceNotFound();
        }

        $teamInvite->update(['status' => 1]);

        if (!$user || !$token || !$team) {
            return $this->resourceNotFound();
        }

        $existMembersIds = $team->members->pluck('pivot.user_id')->toArray();
        $alreadyMember = in_array($user->id, $existMembersIds);

        if (!$alreadyMember) {
            $team->addMember($user, ['isLeader' => false, 'checked_in' => true]);
        }

        return $this->successApiResponse();
    }

    public function edit($id, TeamRequest $request)
    {
        $team = Team::find($id);

        foreach ($request->all() as $key => $value) {
            $team->{$key} = $value;
        }
        $team->save();

        return response()->json(['status' => 'success']);
    }

    public function detail(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'team_id' => ['required', 'numeric']
            ]
        );
        return response()->json(Team::findOrFail($request->team_id));
    }

    public function delete(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'team_id' => ['required', 'numeric']
            ]
        );

        $team = Team::find($request->team_id);
        $team->delete();

        return response()->json(['status' => 'success']);
    }

    /**
     * @param $email
     * @param $team
     * @return JsonResponse|null
     */
    protected function createTeamInvitation($email, Team $team)
    {
        $existInvitation = TeamInvite::where('email', $email)
            ->where('team_id', $team->team_id)
            ->first();

        if ($existInvitation || !$email) {
            return null;
        }

        $existUser = User::where('email', $email)->first();
        $token = Hash::make($email.$team->team_id);

        $invite = new TeamInvite();
        $invite->token = $token;
        $invite->user_id = $existUser->id ?? null;
        $invite->team_id = $team->team_id;
        $invite->email = $email;
        $invite->status = 0;
        $invite->save();
        /*Mail::send('emails.invite', [
            'token' => $token
        ], function ($m) use ($email) {
            $m->from(getenv('MAIL_USERNAME'), getenv('MAIL_FROM_NAME'));

            $m->to($email,'')->subject('You have been invited to the team !');
        });*/
    }
}
