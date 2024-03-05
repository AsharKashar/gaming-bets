<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\MatchUser
 *
 * @property int $id
 * @property int $match_id
 * @property int $team_id
 * @property int $user_id
 * @property int $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $result_data
 * @property int|null $kills
 * @property int|null $deaths
 * @property int|null $assists
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereAssists($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereDeaths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereKills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchUser whereResultData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchUser withoutTrashed()
 */
class MatchUser extends Model
{
    protected $fillable = [
        'match_id',
        'team_id',
        'user_id',
        'points'
    ];
}
