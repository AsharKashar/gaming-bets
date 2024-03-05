<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\BoxmatchUser
 *
 * @property int $id
 * @property int $match_id
 * @property int $user_id
 * @property string $username
 * @property int|null $is_host
 * @property int $team_id
 * @property string|null $result
 * @property string|null $proof_image
 * @property string|null $proof_video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Model\BoxMatches $boxmatch
 * @property-read \App\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxmatchUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereIsHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereProofImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereProofVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxmatchUser whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxmatchUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxmatchUser withoutTrashed()
 * @mixin \Eloquent
 */
class BoxmatchUser extends Model
{
    use SoftDeletes;

    //
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function boxmatch()
    {
        return $this->belongsTo(BoxMatches::class, 'match_id');
    }
}
