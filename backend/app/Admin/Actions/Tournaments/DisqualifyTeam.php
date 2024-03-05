<?php

namespace App\Admin\Actions\Tournaments;

use App\Model\Match;
use App\Model\MatchTeam;
use App\Model\MatchUser;
use App\Model\Status;
use App\Model\Team;
use App\Model\TeamTournament;
use App\Model\UserNotification;
use App\Service\TournamentTeamsService;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class DisqualifyTeam extends RowAction
{
    public $name = 'Disqualify Team';

    public function handle(TeamTournament $teamTournament)
    {
        TournamentTeamsService::returnTeamTournamentByIds([$teamTournament->id],
            UserNotification::$NOTIFICATION_REASON['team_kicked']);
        Match::find($teamTournament->match_id)->update([
            'status' => Status::getIdByMatchType('cancelled')
        ]);
        $matchTeams = MatchTeam::where('team_id', $teamTournament->team_id);
        $matchUsers = MatchUser::where('team_id', $teamTournament->team_id);
        $matchUsers->delete();
        $matchTeams->delete();

        return $this->response()->success('Team disqualified.')->refresh();
    }

}
