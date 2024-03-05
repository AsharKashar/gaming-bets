<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadEvidenceRequest;
use App\Http\Resources\MatchCollection;
use App\Model\Evidence;
use App\Model\MatchReport;
use App\Model\Match;
use App\Model\Status;
use App\Model\Tournament;
use App\Model\TournamentPrize;
use Illuminate\Http\Request;
use App\Service\S3Service;
use App\Service\TournamentService;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\{
    Builder
};

class MatchesController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/matches/{match_id}/upload-evidence",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="match_id",
     *     in="path",
     *     description="ID of the match",
     * ),
     * @OA\Parameter(
     *     name="kills",
     *     in="query",
     *     description="Team kills",
     *     required=true
     * ),
     * @OA\Parameter(
     *     name="assists",
     *     in="query",
     *     description="Team assists",
     *     required=true
     * ),
     * @OA\Parameter(
     *     name="place",
     *     in="query",
     *     description="Team place in leaderboard",
     *     required=true
     * ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             description="upload evidence file",
     *                             property="files[]",
     *                             type="array",
     *                             @OA\Items(type="string", format="binary")
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Evidence upload for match"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     * @param UploadEvidenceRequest $request
     * @param Match $match
     * @return \Illuminate\Http\JsonResponse
     */

    public function uploadEvidence(UploadEvidenceRequest $request, Match $match)
    {
        $user = Auth::user();
        $matchTeam = $match->getMatchTeamByUser($user);

        if (!$user || !$matchTeam) {
            return $this->resourceNotFound();
        }

        if (Evidence::where('match_team_id',$matchTeam->id)->first()) {
            return $this->internalErrorApiResponse([],'Evidence already uploaded');
        }

        $data=[
            'files' => $request->files->get('files') ?? [],
            'kills' => $request->kills,
            'assists' => $request->assists,
        ];

        if ($match->uploadEvidence($matchTeam, $data)) {
            $matchTeam->update([
                'place' => $request->place
            ]);
            return $this->successApiResponse();
        }

        return $this->internalErrorApiResponse();
    }


    /**
     * @OA\Get(
     *     path="/api/bracket-match/view-bracket-structure/{tournament_id}",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="tournament_id",
     *     in="path",
     *     description="ID of the tournament",
     * ),
     *     @OA\Response(response="200", description="view tournament bracket structure"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function viewStructure($tournament_id)
    {
        $user = Auth::user();
        if(!$user){
            return response()->json(
                ['error' => 'Authorization Token not found'],
                403
            );
        }
        // $user = User::find(2);
        $foundTeam=null;
        $tournament = Tournament::find($tournament_id);
        return $user;
        foreach ($user->teams as $team)
        {
            foreach($tournament->teams as $t_teams){
                if($team->id == $t_teams->id){
                    $foundTeam = $team;
                    break;
                }
            }
        }
        $matches=[];
        $getFinal = Match::where('tournament_id', $tournament_id)->where('is_final',1)->first();
        if($getFinal){
            $rounds = $getFinal->round;
            for( $i = 1; $i<= $rounds ; $i++){
                $matches['round'.$i] = Match::where('tournament_id', $tournament_id)->where('round',$i)->with('teamA.members')->with('teamB.members')->with('winnerTeam.members')->get();
            }
        }

            foreach($matches as $key=>$round){
                foreach($round as $keys=>$match){
                    $matches[$key][$keys]['round_matches_1'] = 1;
                    $matches[$key][$keys]['round_matches_2'] = 2;
                    if($match->winner_id){
                        if($match->winner_id == $match->team_1){
                            $matches[$key][$keys]['winner_slot'] = 1;
                        }
                        if($match->winner_id == $match->team_2){
                            $matches[$key][$keys]['winner_slot'] = 2;
                        }
                    }
                    else{
                        $matches[$key][$keys]['winner_slot'] = null;
                    }
                    $matches[$key][$keys]['start_at_formatted'] = Carbon::parse($matches[$key][$keys]->start_at)->format('M jS, H:i');

                    if($foundTeam){
                        if($match->team_1 == $foundTeam->team_id){
                            $matches[$key][$keys]['current_user_team_slot'] = 1;
                            $matches[$key][$keys]['current_user_team_id'] = $foundTeam->team_id;

                        }
                        if($match->team_2 == $foundTeam->team_id){
                            $matches[$key][$keys]['current_user_team_slot'] = 2;
                            $matches[$key][$keys]['current_user_team_id'] = $foundTeam->team_id;
                        }
                    }
                }
        }

        if($foundTeam){
            $data['groups_information'] = [
                'total_groups' => 1,
                'user_team_present_in_group' => 1,
                'user_team_id' => $foundTeam->team_id,
                'user_team_name' => $foundTeam->name,
            ];
        }

        $data['1'] = $matches;

        return $data;
    }


    /**
     * @OA\Get(
     *     path="/api/tournaments/{tournament}/matches",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="tournament",
     *     in="path",
     *     description="ID of the tournament",
     *     required=true
     * ),
     * @OA\Parameter(
     *     name="perPage",
     *     in="query",
     *     description="matches per page",
     * ),
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="page",
     * ),
     * @OA\Parameter(
     *     name="matchesType",
     *     in="query",
     *     description="Type of matches",
     *     required=true,
     *     @OA\Schema(
     *     type="array",
     *       @OA\Items(
     *           type="string",
     *           enum={"live", "pending", "past", "upcoming"},
     *           default="live"
     *       ),
     *     ),
     *     style="form"
     * ),
     *     @OA\Response(response="200", description="get all matches for current user for selected tournament")
     * )
     * @param Request $request
     * @param Tournament $tournament
     * @return \Illuminate\Http\JsonResponse
     */

    public function getTournamentMatches(Request $request, Tournament $tournament)
    {
        $user = Auth::user();
        $perPage = $request->perPage ?? 10;

        if (!$tournament) {
            return $this->resourceNotFound();
        }

        $userTeam = null;
        if ($user && $userTeam = $tournament->getUserValidTeam($user->id)) {
            $query = Match::where('tournament_id', $tournament->id)
                ->whereHas('teams', function ($query) use ($userTeam) {
                    $query->where(['teams.team_id' => $userTeam->team_id]);
                });
        } else {
            $query = $tournament->matches();
        }

        $matchesType = $request->input('matchesType');

        switch ($matchesType) {
            case 'live':{
                $matches = (clone $query)->where('status_id', Status::getIdByMatchType(Status::MATCH_TYPES['live']))
                    ->orWhere('status_id', Status::getIdByMatchType(Status::MATCH_TYPES['pending_results']));
                break;
            }
            case 'past':{
                $matches = (clone $query)->where('status_id', Status::getIdByMatchType(Status::MATCH_TYPES['ended']));
                break;
            }
            case 'pending':{
                $matches = (clone $query)->where('status_id', Status::getIdByMatchType(Status::MATCH_TYPES['pending_results']))
                    ->orWhere('status_id', Status::getIdByMatchType(Status::MATCH_TYPES['conflict']));
                break;
            }
            case 'upcoming':{
                $matchesQuery = (clone $query)->where('status_id', Status::getIdByMatchType(Status::MATCH_TYPES['created']))
                    ->orWhere('status_id', Status::getIdByMatchType(Status::MATCH_TYPES['full']))
                    ->orWhere('status_id', Status::getIdByMatchType(Status::MATCH_TYPES['teams_added']));


                $matches = $matchesQuery->withCount('teams')
                    ->having('teams_count','>','1');
                break;
            }
            default:{
                return $this->resourceNotFound();
            }
        }

        $matches->orderBy('start_at','asc');
        $resource = new MatchCollection($matches->paginate($perPage));
        $resource = $resource->toArray();
        $resource['user_team_id'] = optional($userTeam)->team_id;
        return $this->successApiResponse($resource);
    }


    /**
     * @OA\Get(
     *     path="/api/tournaments/{tournament}/brackets",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="tournament",
     *     in="path",
     *     description="ID of the tournament",
     *     required=true
     * ),
     *     @OA\Response(response="200", description="Get matches list for brackets")
     * )
     * @param Request $request
     * @param Tournament $tournament
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTournamentBrackets(Request $request, Tournament $tournament)
    {
        if (!$tournament || !$matches = $tournament->matches) {
            return $this->resourceNotFound();
        }

        $rounds = [];

        foreach ($tournament->rounds() as $round) {
            $matches = $tournament->matches()->where('round', $round)->with('teams')->get()->toArray();
            $rounds[$round] = $matches;
        }

        return $this->successApiResponse($rounds);
    }


    /**
     * @OA\Get(
     *     path="/api/bracket-match/view-matches/{match_id}",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="match_id",
     *     in="path",
     *     description="ID of the bracket match",
     * ),
     *     @OA\Response(response="200", description="view tournament bracket match details"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */

    public function getMatch($match_id)
    {
        $match = Match::where('match_id', $match_id)->with('teamA.members')->with('teamB.members')->first();
        return $match;
    }

    /**
     * @OA\Get(
     *     path="/api/bracket-match/view-final/{tournament_id}",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="tournament_id",
     *     in="path",
     *     description="ID of the tournament",
     * ),
     *     @OA\Response(response="200", description="view tournament final with result if exists"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */

    public function getFinal($tournament_id)
    {
            return Match::where('tournament_id', $tournament_id)->where('is_final', 1)->with('winnerTeam.members')->with('teamA.members')->with('teamB.members')->first();
    }

    public function getlad($tournament_id){
        $tournament = Tournament::find($tournament_id);
        $matches = Match::where('tournament_id', $tournament_id)->get();
        $teams = $tournament->teams;
        foreach($teams as $key=>$team){
            $wins = 0;
            foreach($matches as $match){
                if($match->winner_id == $team->team_id){
                    $wins = $wins + 1;
                }
            }
            $teams[$key]['wins'] = $wins;
        }
        $teams = collect($teams);

        $teams = $teams->sortByDesc('wins');
        $teams = $teams->all();
        $arr=[];
        foreach($teams as $t){
            $arr[] = $t->team_id;
        }
        // return $arr;
        return TournamentService::setTournamentWinners($tournament, $arr);
    }

    /**
     * @OA\Get(
     *     path="/api/bracket-match/view-ladder/{tournament_id}",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="tournament_id",
     *     in="path",
     *     description="ID of the tournament",
     * ),
     *     @OA\Response(response="200", description="view tournament ladder")
     * )
     */

    public function getTournamentladder($tournament_id){
        $tournamentPrizes = TournamentPrize::where('tournament_id', $tournament_id)->with('team.members')->get();
        return $tournamentPrizes;
    }

    /**
     * @OA\Post(
     *     path="/api/bracket-match/report-match-upload/{report_id}",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="report_id",
     *     in="path",
     *     description="ID of the match",
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
     *   @OA\Response(response="200", description="Upload file for a report of a match"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */

    public function reportMatchUpload(request $request, $report_id)
    {
        $this->validate(
            $request->all(),
            [
                // 'description' => ['required'],
            ]
        );
        $user = Auth::user();
        if(!$user){
            return response()->json(
                [
                    'message' => "User not found"
                ]
                );
        }
        $report = MatchReport::find($report_id);
        if ($request->file) {
            if (in_array(
                $request->file->getClientMimeType(),
                [
                    'image/jpeg',
                    'image/png',
                ]
            )) {
                if ($path = S3Service::uploadFile('FAQ', $request->file, "guest")) {
                    $prefix = config('services.awsurl.url');
                    $report->file_url = $prefix.$path;
                }
            } else {
                return response()->json(
                    [
                        'message' => 'Invalid file type. Only .png and .jpeg allowed'
                    ],
                    400
                );
            }
        }
        $report->save();
        return response()->json(
            [
                'status' => 'success',
                'result' => 'true',
                'message' => 'Report Submitted'
            ]
        );
    }


    /**
     * @OA\Post(
     *     path="/api/bracket-match/report-match-details/{match_id}",
     *     tags={"matches"},
     * @OA\Parameter(
     *     name="match_id",
     *     in="path",
     *     description="ID of the match",
     * ),
     * @OA\Parameter(
     *     name="topic",
     *     in="query",
     *     description="topic of the report",
     * ),
     * @OA\Parameter(
     *     name="description",
     *     in="query",
     *     description="description of the report",
     * ),
     *   @OA\Response(response="200", description="Submit a report details for a match"),
     * security={
     *         {"query_token": {}}
     *     }
     * )
     */

    public function reportMatchDetails(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'topic' => ['required'],
                'description' => ['required'],
            ]
        );
        $user = Auth::user();
        if(!$user){
            return response()->json(
                [
                    'message' => "User not found"
                ]
                );
        }
        $report = new MatchReport();
        $report->user_id = $user->id;
        $report->match_id = $request->match_id;
        $report->topic = $request->topic;
        $report->description = $request->description;
        $report->save();
        return response()->json(
            [
                'status' => 'success',
                'result' => 'true',
                'message' => 'Report Submitted',
                'report_id' => $report->id,
            ]
        );
    }

}
