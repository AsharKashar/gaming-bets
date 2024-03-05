<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BoxMatchInvite
 *
 * @property int $id
 * @property int $match_id
 * @property int $team_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchInvite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BoxMatchInvite extends Model
{
    //
    public static function deleteIfMatchFull($match_id)
    {
        $match = BoxMatches::find($match_id);
        if ($match->status == BoxMatches::MATCH_IS_FULL) {
            $invites = self::where('match_id', $match->id)->delete();
        }
    }
}
