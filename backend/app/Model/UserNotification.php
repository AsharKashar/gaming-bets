<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserNotification
 *
 * @property int $id
 * @property string $reason
 * @property int $user_id
 * @property mixed|null $data
 * @property int $read
 * @property int $force_modal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification whereForceModal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserNotification whereUserId($value)
 * @mixin \Eloquent
 */
class UserNotification extends Model
{
    public static $NOTIFICATION_REASON = [
        'tournament_start' => 'tournament_start',
        'join_tournament' => 'join_tournament',
        'cancel_tournament' => 'cancel_tournament',
        'bombs_refund' => 'bombs_refund',
        'join_tournament_invitation' => 'join_tournament_invitation',
        'tournament_will_start_soon' => 'tournament_will_start_soon',
        'team_kicked' => 'team_kicked',
        'match_is_finished' => 'match_is_finished',
        'result_conflict' => 'result_conflict',
        'match_win' => 'match_win',
        'create_match' => 'create_match',
        'host_creating_match' => 'host_creating_match',
        'match_will_start_soon' => 'match_will_start_soon',
        'join_match' => 'join_match',
        'match_loose' => 'match_loose',
        'challenge_pre_start' => 'challenge_pre_start',
        'challenge_join_same_team' => 'challenge_join_same_team',
        'challenge_join_opponent_team' => 'challenge_join_opponent_team',
        'challenge_cancelled' => 'challenge_cancelled',
        'challenge_started' => 'challenge_started',
        'challenge_time_ended' => 'challenge_time_ended',
        'challenge_finished' => 'challenge_finished',
        'challenge_conflict' => 'challenge_conflict',
        'challenge_delete' => 'challenge_delete',
    ];

    protected $fillable = [
        'reason',
        'user_id',
        'data',
        'read',
        'force_modal'
    ];

    public function getDataAttribute($data)
    {
        return json_decode($data, true) ?: [];
    }

    public function setDataAttribute($data)
    {
        if (is_array($data)) {
            $this->attributes['data'] = json_encode($data);
        }
    }
}
