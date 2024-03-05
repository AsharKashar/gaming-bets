<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $winnerTeam = $this->winnerTeam();
        $winnerTeamId = optional($winnerTeam)->team_id;
        $hostTeamId = optional($this->hostTeam())->team_id;

        return [
            'match_id' => $this->match_id,
            'title' => $this->title,
            'start_at' => $this->start_at,
            'conflict_end_at' => $this->conflict_end_at,
            'winner_team_id' => $winnerTeamId,
            'winner_users_ids' => $winnerTeam ? $winnerTeam->members()->pluck('users.id') : [],
            'host_team_id' => $hostTeamId,
            'teams' => $this->itemsMatchTeams()->with(['team','evidence'])->get(),
            'status' => $this->status
        ];
    }
}
