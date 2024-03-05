<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BoxMatchResult
 *
 * @property int $id
 * @property int $boxmatch_id
 * @property int $user_id
 * @property int $winnings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Model\BoxMatches $match
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatchResult onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult whereBoxmatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchResult whereWinnings($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatchResult withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatchResult withoutTrashed()
 * @mixin \Eloquent
 */
class BoxMatchResult extends Model
{
    use SoftDeletes;

    public function match()
    {
        return $this->belongsTo(BoxMatches::class, 'boxmatch_id');
    }

    //
    public static function addwinner($match_id, $user_id, $winnings)
    {
        $winnerRecord = new self();
        $winnerRecord->boxmatch_id = $match_id;
        $winnerRecord->user_id = $user_id;
        $winnerRecord->winnings = $winnings;
        $winnerRecord->save();
        return true;
    }

    public static function getBoxFightLadder($users, $game_id)
    {
        $data = [];
        foreach ($users as $key => $user) {
            $data[$key]['winnings'] = 0;
            $data[$key]['match_won'] = 0;
            $results = self::where('user_id', $user->id)->with('match')->get();
            foreach ($results as $result) {
                $matchParent = BoxMatches::withTrashed()->where('id', $result->boxmatch_id)->first();
                if ($matchParent->game_id == $game_id) {
                    $data[$key]['winnings'] = $data[$key]['winnings'] + $result->winnings;
                    $data[$key]['match_won'] += 1;
                }
            }
            $data[$key]['users'] = $user;
        }
        return $data;
    }


    public static function getboxwinnings($user_id, $game_id)
    {
        $winnings = 0;
        $results = self::where('user_id', $user_id)->with('match')->get();
        if ($results) {
            foreach ($results as $result) {
                $matchParent = BoxMatches::withTrashed()->where('id', $result->boxmatch_id)->first();
                if ($matchParent->game_id == $game_id) {
                    $winnings = $winnings + $result->winmings;
                }
            }
        }
        return $winnings;
    }
}
