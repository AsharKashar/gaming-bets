<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\MatchTeam
 *
 * @property int $id
 * @property int $match_id
 * @property int $team_id
 * @property int|null $place
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Model\Match $match
 * @property-read \App\Model\Team $team
 * @property string|null $result_data
 * @property int|null $score
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchTeam onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam whereResultData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchTeam whereScore($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchTeam withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchTeam withoutTrashed()
 */
class MatchTeam extends Model
{
    protected $fillable = [
        'match_id',
        'team_id',
        'place'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class,'team_id','team_id');
    }

    public function match()
    {
        return $this->belongsTo(Match::class,'match_id','match_id');
    }

    public function evidence()
    {
        return $this->hasOne(Evidence::class, 'match_team_id', 'id');
    }
}
