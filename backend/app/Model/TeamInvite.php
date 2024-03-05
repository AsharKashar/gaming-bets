<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon as CarbonAlias;

/**
 * App\Model\TeamInvite
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $email
 * @property int $team_id
 * @property string $token
 * @property int|null $status
 * @property CarbonAlias|null $created_at
 * @property CarbonAlias|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamInvite whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Model\User|null $user
 */
class TeamInvite extends Model
{

    public const STATUS_INVITE = [
        'invited' => 0,
        'accepted' => 1,
    ];

    protected $table = "user_invite";
    protected $with = ['user'];

    protected $fillable = [
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
