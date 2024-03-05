<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Leaderboard
 *
 * @property int $id
 * @property int $user_id
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Leaderboard onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Leaderboard whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Leaderboard withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Leaderboard withoutTrashed()
 * @mixin \Eloquent
 */
class Leaderboard extends Model
{
    use SoftDeletes;

    //

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function arrangeAndgetTopThree($users)
    {
        $users = collect($users);
        $return = $users->sortByDesc('points');
        return $return->take(3);
    }

    public static function deleteAllEntries($leaderboards)
    {
        foreach ($leaderboards as $leaderboard) {
            $leaderboard->delete();
        }
    }


    public static function topThreeLeaderboard()
    {
        $users = User::where('user_type', 'user')->get();
        foreach ($users as $key => $user) {
            // $user_winnings = UserPoint::getTopPlayerwinnings($user);
            $user_points = UserPoint::where('user_id', $user->id)->first();
            $games = Game::all();
            $boxfight_winnings = 0;
            foreach ($games as $game) {
                $boxfight_winnings = $boxfight_winnings + BoxMatchResult::getboxwinnings($user->id, $game->id);
            }
            $users[$key]['winnings'] = $boxfight_winnings;
            $users[$key]['points'] = $user_points->points;
        }
        $return = self::arrangeAndgetTopThree($users);

        $leaderboards = self::all();
        if ($leaderboards) {
            self::deleteAllEntries($leaderboards);
        }
        $position = 1;
        foreach ($return as $entry) {
            $data = new Leaderboard();
            $data->user_id = $entry->id;
            $data->position = $position;
            $position++;
            $data->save();
        }
    }


    public static function topThreeLeaderboardForSeeder()
    {
        $users = User::where('user_type', 'user')->get();
        foreach ($users as $key => $user) {
            // $user_winnings = UserPoint::getTopPlayerwinnings($user);
            $user_points = UserPoint::where('user_id', $user->id)->first();
            $games = Game::all();
            $boxfight_winnings = 0;
            foreach ($games as $game) {
                $boxfight_winnings = $boxfight_winnings + BoxMatchResult::getboxwinnings($user->id, $game->id);
            }
            $user['winnings'] = $boxfight_winnings;
            $user['points'] = $user_points? $user_points->points : 0;
        }
        $return = self::arrangeAndgetTopThree($users);

        $leaderboards = self::all();
        if ($leaderboards) {
            self::deleteAllEntries($leaderboards);
        }
        $position = 1;
        foreach ($return as $entry) {
            $data = new Leaderboard();
            $data->user_id = $entry->id;
            $data->position = $position;
            $position++;
            $data->save();
        }
    }

}
