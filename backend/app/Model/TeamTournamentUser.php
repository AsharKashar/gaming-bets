<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TeamTournamentUser
 *
 * @property int $id
 * @property int $team_tournament_id
 * @property string $email
 * @property int $bomb_payed
 * @property-read \App\Model\TeamTournament|null $teamTournament
 * @property-read \App\Model\Tournament|null $tournament
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournamentUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournamentUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournamentUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournamentUser whereBombPayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournamentUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournamentUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournamentUser whereTeamTournamentId($value)
 * @mixin \Eloquent
 * @property-read \App\Model\User|null $user
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamTournamentUser whereUserId($value)
 */
class TeamTournamentUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'team_tournament_id',
        'email',
        'user_id',
        'bomb_payed'
    ];

    public function tournament()
    {
        return $this->hasOneThrough(Tournament::class, TeamTournament::class, 'id','id', 'team_tournament_id', 'tournament_id');
    }

    public function teamTournament()
    {
        return $this->hasOne(TeamTournament::class,'id','team_tournament_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
