<?php


namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Model\Status;
use App\Model\Tournament;
use App\Service\BracketService;
use App\Service\TournamentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class TournamentToolsController extends Controller
{
    public function addDemoPlayers($id, Request $request)
    {
        // TODO: add demo players to tournament for Fortnite
        return redirect("/admin/tournament/$id/edit");
    }

    public function addDemoTeams($id, Request $request)
    {
        $tournament = Tournament::find($id);
        if ($tournament->status->type === Status::TOURNAMENT_TYPES['registration']) {
            TournamentService::seedDemoTeamsToTournament($tournament, $request->teamCount);
            return redirect("/admin/tournament/$id/edit");
        }

        return back();
    }

    public function endRegistration($id, Request $request)
    {
        $tournament = Tournament::find($id);
        $tournament->status_id = Status::getIdByTournamentType('finish_registration');
        $tournament->reg_end_at = Carbon::createFromDate($request->reg_end_at)->format('Y-m-d H:i:s');
        $tournament->status_id = Status::where('group', Status::GROUPS['tournament'])
            ->where('type',Status::TOURNAMENT_TYPES['finish_registration']);
        $tournament->save();

        return redirect("/admin/tournament/$id/edit");
    }

    public function startRegistration($id, Request $request)
    {
        $tournament = Tournament::find($id);
        $tournament->reg_start_at = Carbon::createFromDate($request->reg_start_at)->format('Y-m-d H:i:s');
        $tournament->status_id = Status::where('group', Status::GROUPS['tournament'])
            ->where('type',Status::TOURNAMENT_TYPES['registration']);
        $tournament->save();

        return redirect("/admin/tournament/$id/edit");
    }

    public function prepareStructure($id, BracketService $bracketService)
    {
        $tournament = Tournament::find($id);
        $tournament->reg_end_at = Carbon::now()->format('Y-m-d H:i:s');
        $tournament->status_id = Status::getIdByTournamentType('finish_registration');
        $tournament->save();

        $bracketService
            ->setTournament($tournament)
            ->cleanUpStructure()
            ->validateTournament()
            ->generateStructure()
            ->mixtureFirstRound()
        ;
        return redirect("/admin/tournament/$id/edit");
    }
}
