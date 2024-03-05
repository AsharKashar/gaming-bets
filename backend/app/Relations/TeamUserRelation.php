<?php

namespace App\Relations;

use App\Model\BaseModel as Model;
use App\Model\User;

/**
 * App\Relations\TeamUserRelation
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string $activision
 * @property int $checked_in
 * @property int $is_leader
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereActivision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereCheckedIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereIsLeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Model\User $user
 */
class TeamUserRelation extends Model
{
    protected $table = "team_user_relation";

    protected $fillable = [
        'team_id',
        'user_id',
        'activision',
        'checked_in',
        'is_leader'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function getJoinedTeam($id)
    {
        $teams = self::where('user_id', $id)->get();
        return $teams;
    }
}