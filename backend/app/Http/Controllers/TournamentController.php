<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\JoinTournament;
use App\Model\BombHistory;
use App\Model\Frequency;
use App\Model\Game;
use App\Model\GamePlatform;
use App\Model\Team;
use App\Model\TeamTournament;
use App\Model\TeamTournamentUser;
use App\Model\Tournament;
use App\Model\TournamentOptions;
use App\Service\BombsPayment;
use App\Service\LocaleServices;
use App\Service\NotificationsService;
use App\Service\TournamentService;
use App\Service\TournamentTeamsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\{
    Builder
};

class TournamentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tournaments",
     *     tags={"tournaments"},
     * @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="Tournaments per page default(10)",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Tournaments current page default(1)",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="featured",
     *     in="query",
     *     description="Receive only featured tournaments",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="game_mode",
     *     in="query",
     *     description="Game mode id",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="game_type",
     *     in="query",
     *     description="Game type id",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="platform",
     *     in="query",
     *     description="Platform id",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="repeat",
     *     in="query",
     *     description="Repeat type id",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     description="Game id",
     *     required=false,
     * ),
     *     @OA\Response(response="200", description="Returns tournament list")
     * )
     */
    public function list(Request $request)
    {
        $perPage = $request->input('per_page') ?? 10;
        $exclude = $request->input('exclude');
        $name = $request->input('name');
        $gameMode = $request->input('game_mode');
        $gameType = $request->input('game_type');
        $platform = $request->input('platform');
        $repeat = $request->input('repeat');
        $gameId = $request->input('game_id');
        $query = Tournament::query()->with(['gameType', 'gameMode', 'platforms', 'prizes', 'regions', 'status']);

        //$query->where('featured', true);

        if ($exclude) {
            $query->whereNotIn('id', $exclude);
        }

        if ($gameMode) {
            $query->where('game_mode_id', $gameMode);
        }

        if ($gameType) {
            $query->where('game_type_id', $gameType);
        }

        if ($name) {
            $query->where('name', 'LIKE', '%'.$name.'%');
        }

        if ($platform) {
            $query->whereHas(
                'platforms',
                function (Builder $q) use ($platform) {
                    $q->where(['game_platform_id' => $platform]);
                }
            );
        }


        if ($repeat) {
            $query->where('frequency_id', $repeat);
        }

        if ($gameId) {
            $query->where('game_id', $gameId);
        }

        $query->orderBy('featured', 'desc')->orderBy('created_at', 'desc');

        return $this->successApiResponse($query->paginate($perPage));
    }

    /**
     * @OA\Get(
     *     path="/api/tournaments/filters",
     *     tags={"tournaments"},
     * @OA\Parameter(
     *     name="gameId",
     *     in="query",
     *     description="Game id",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Returns available filters for tournament list")
     * )
     */
    public function getFilters(Request $request)
    {
        $game = Game::find($request->input('gameId'));

        if (!$game) {
            return $this->resourceNotFound();
        }

        $filters = [
            'gameMode' => $game->gameModes,
            'platform' => GamePlatform::all()->toArray(),
            'repeat' => Frequency::all()->toArray()
        ];

        return $this->successApiResponse($filters);
    }

    /**
     * @OA\Get(
     *     path="/api/tournaments/{tournamentId}",
     *     tags={"tournaments"},
     * @OA\Parameter(
     *     name="tournamentId",
     *     in="path",
     *     description="Tournament ID",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Returns tournament")
     * )
     */
    public function show($tournamentId) {
        $tournament = Tournament::with(['prizes', 'regions', 'results',
            'status', 'game', 'platforms' ])->with([
            'teams' => function($query) use ($tournamentId) {
                $query->where(['tournament_id' => $tournamentId, 'is_valid' => 1])->orderBy('created_at', 'desc');
            },
            'gameMode' => function($query) {
                $query->with('gameTypes');
            },
        ])->find($tournamentId);

        if (!$tournament) {
            return $this->resourceNotFound();
        }
        $res = $tournament->toArray();
        $res['teams'] = $tournament->teams->slice(0, 6);
        $res['tournament_links'] = TournamentService::getTournamentLinks($tournament);

        return $this->successApiResponse($res);
    }

    /**
     * @OA\Get(
     *     path="/api/tournaments/{tournament}/teams/user",
     *     tags={"tournaments"},
     *
     * @OA\Parameter(
     *     name="tournament",
     *     in="path",
     *     description="Tournament id",
     *     required=true,
     *     ),
     *  @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page",
     *     required=false,
     *  ),
     *  @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="Per page",
     *     required=false,
     *  ),
     *   @OA\Response(response="200", description="Returns current user teams for tournament"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function getCurrentUserTeamsTournament(Tournament $tournament, Request $request)
    {
        $user = auth()->user();

        $teamsFitsToTournament = $user->teams()->where(['team_size_id' => $tournament->team_size->id, 'game_id' => $tournament->game_id]);
        $teamsFitsToTournamentIds = $teamsFitsToTournament->pluck('teams.team_id');

        $teamsInTournament = $teamsFitsToTournament->whereHas('teamTournament' , function($query) use ($tournament) {
                $query->where(['tournament_id' => $tournament->id]);
        });
        $teamsInTournamentIds = $teamsInTournament->pluck('teams.team_id');
        $allIds = $teamsInTournamentIds->merge($teamsFitsToTournamentIds)->unique()->toArray();

        $teams = Team::whereIn('team_id', $allIds)
            ->orderByRaw("FIELD(team_id, ".implode(',', $allIds).")");

        return $this->successApiResponse(
            $teams->paginate($request->input('per_page') ?? 4)
        );
    }

    /**
     * @OA\Post(
     *     path="/api/tournaments/{tournament}/join",
     *     tags={"tournaments"},
     * @OA\Parameter(
     *     name="tournament",
     *     in="path",
     *     description="Tournament ID",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="team_id",
     *     in="query",
     *     description="Team id",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Join to tournament"),
     *      security={
     *         {"query_token": {}}
     *     }
     * )
     * @param  JoinTournament  $request
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\JsonResponse
     */
    public function joinTournament(JoinTournament $request, Tournament $tournament)
    {
        if ($tournament->tournament_size['players_actual_count'] >= $tournament->tournament_size['players_count']) {
            return $this->internalErrorApiResponse([], 'Player tournament max!');
        }

        $team = Team::firstWhere('team_id', $request->input('team_id'));

        if (!$team || !$tournament) {
            return $this->resourceNotFound('Team not found');
        }

        $user = auth()->user();

        if($team->sizes->size !== $tournament->team_size->size || !$team->members()->firstWhere('user_id', $user->id)) {
            return $this->internalErrorApiResponse([], 'Team invalid!');
        }

        $teamTournament = TeamTournament::firstWhere(['team_id' => $team->team_id, 'tournament_id' => $tournament->id]);
        $userJoined = TeamTournamentUser::firstWhere(['user_id' => $user->id, 'team_tournament_id' => optional($teamTournament)->id, 'bomb_payed' => 1]);

        if (TournamentTeamsService::limitTeam($team)) {
            return $this->internalErrorApiResponse([],'Team limit exceeded');
        }

        if (optional($teamTournament)->is_valid){
            return $this->internalErrorApiResponse([], 'Full team!');
        }

        if ($userJoined) {
            return $this->internalErrorApiResponse([], 'You have already joined!');
        }

        $payment = BombsPayment::userPayBombs(
            $user,
            $tournament->entry_fee,
            BombHistory::TYPES['tournament'],
            $tournament->id
        );

        if ($payment === 'not_money') {
            return $this->internalErrorApiResponse([], 'Not enough bomb!', 403);
        }
        if ($payment === 'not_create') {
            return $this->internalErrorApiResponse([], 'Some error occurred!');
        }

        try {
            TournamentTeamsService::joinTeam($team, $tournament, $user);
            NotificationsService::joinTournamentNotification($tournament, $user->id);
            return $this->successApiResponse();
        } catch (Exception $e) {
            return $this->internalErrorApiResponse($e, 'Some error occurred!');
        }
    }

    /**
     * @OA\Post(
     *     path="/api/tournaments/joined",
     *     tags={"tournaments"},
     * @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="Tournaments per page default(10)",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Tournaments current page default(1)",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="game_type",
     *     in="query",
     *     description="Game type id",
     *     required=false,
     * ),
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     description="Game id",
     *     required=false,
     * ),
     * @OA\Response(response="200", description="auth token"),
     *     security={
     *         {"query_token": {}}
     *     }
     * ),
     * @OA\Response(response="200", description="Returns joined tournaments list")
     * )
     */
    public function joinedTournaments(Request $request)
    {

        $perPage = $request->input('per_page') ?? 10;
        $gameType = $request->input('game_type');
        $gameId = $request->input('game_id');

        $teamTournamentUsers = TeamTournamentUser::where(['user_id' => auth()->user()->id, 'bomb_payed' => 1]);

        if (!$teamTournamentUsers) {
            return $this->successApiResponse([]);
        }
        $tournamentIds = [];

        $teamTournamentUsers->get()->each(function($teamTournamentUser) use (&$tournamentIds) {
            $tournamentIds[] = $teamTournamentUser->tournament->id;
        });

        $tournaments = Tournament::whereIn('id', $tournamentIds);

        if ($gameType) {
            $tournaments->where('game_type_id', $gameType);
        }

        if ($gameId) {
            $tournaments->where('game_id', $gameId);
        }


        return $this->successApiResponse(
            $tournaments->paginate($perPage)
        );
    }

    /**
     * @OA\Get(
     *     path="/api/tournaments/{tournament}/teams",
     *     tags={"tournaments"},
     *
     * @OA\Parameter(
     *     name="tournament",
     *     in="path",
     *     description="Tournament id",
     *     required=true,
     *     ),
     *  @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page",
     *     required=false,
     *  ),
     *  @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="Per page",
     *     required=false,
     *  ),
     *   @OA\Response(response="200", description="Returns team tournament"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function getTeamTournament(Tournament $tournament, Request $request)
    {
        return $this->successApiResponse(
            $tournament->teams()->where('is_valid', 1)->with(['members'])->paginate($request->input('per_page') ?? 16)
        );
    }


    public function getTournamentRules(Tournament $tournament) {

        $tournamentRules = $tournament->options()->where(['type' => 'rules'])->get();
        $rules = [];
        if ($tournamentRules->isNotEmpty()) {
            $rules = LocaleServices::getFirstLocaleToCollection($tournamentRules);
        } else {
            $rules = LocaleServices::getFirstLocaleToCollection($tournament->gameModeRules()->get());
        }

        return $this->successApiResponse($rules ?? []);
    }
}
