<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TeamTournament
 *
 * @property int $id
 * @property int $team_id
 * @property int $tournament_id
 * @property int $is_valid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \App\Model\Tournament $tournament
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TeamTournamentUser[] $tournamentUsers
 * @property-read int|null $tournament_users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournament newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournament newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournament query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournament whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournament whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournament whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournament whereTournamentId($value)
 * @mixin \Eloquent
 * @property-read \App\Model\Team $team
 */
class TeamTournament extends Model
{
    protected $table = 'team_tournament';

    public $timestamps = false;

    protected $fillable = [
        'tournament_id',
        'team_id',
        'is_valid',
    ];

    public function teams() {
        return $this->hasMany(Team::class);
    }

    public function tournamentUsers()
    {
        return $this->hasMany(TeamTournamentUser::class);
    }

    public function tournament() {
        return $this->belongsTo(Tournament::class);
    }

    public function team() {
        return $this->belongsTo(Team::class);
    }
}
