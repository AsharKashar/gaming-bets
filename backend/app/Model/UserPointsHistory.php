<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserPointsHistory
 *
 * @property int $id
 * @property int $match_user_id
 * @property int $points
 * @property string $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory whereMatchUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPointsHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserPointsHistory extends Model
{
    protected $fillable = [
        'match_user_id',
        'points',
        'reason',
    ];

    public static $REASONS = [
        'match_join' => 'match_join',
        'match_win' => 'match_win',
        'participation' => 'participation',
        'winedMatch' => 'winedMatch'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function user(){
        return $this->hasOneThrough(User::class, MatchUser::class, 'id', 'id','match_user_id','user_id');
    }
}
