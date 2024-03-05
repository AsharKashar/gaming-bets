<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserPoint
 *
 * @property int $id
 * @property float $points
 * @property float $winning
 * @property int $user_id
 * @property int $tournament_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Game $game
 * @property-read \App\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint whereWinning($value)
 * @mixin \Eloquent
 * @property int $user_level_id
 * @property-read \App\Model\UserLevel|null $level
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserPoint whereUserLevelId($value)
 */
class UserPoint extends Model
{
    protected $guarded = [];
    protected $with =[
        'level'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function level()
    {
        return $this->hasOne(UserLevel::class,'id','user_level_id');
    }

    public static function getUsersPointsWinnings($users, $tournaments)
    {
        $data = [];
        foreach ($users as $key => $user) {
            $user_points = 0;
            $user_winnings = 0;

            foreach ($tournaments as $tournament) {
                    $tourPoint = 0;
                    foreach($tournament->matches as $ma){
                        $sumOfPoints = 0;
                        $userMatch = MatchUser::where('match_id',$ma->match_id)->where('user_id',$user->id)->get();
                        foreach($userMatch as $recs){
                            $sumOfPoints = $sumOfPoints + $recs->points;
                        }
                        $tourPoint = $tourPoint + $sumOfPoints;
                    }
                    $user_points = $user_points + $tourPoint;
            }

            // $data[$key]['winnings'] = $user_winnings;
            $data[$key]['points'] = $user_points;
            $data[$key]['user'] = $user;
        }
        return $data;
    }

    public static function getUsersPointsWinningsAll($users, $tournaments, $gameId)
    {
        $data = [];
        foreach ($users as $key => $user) {
            $user_points = 0;
            $user_winnings = 0;

            foreach ($tournaments as $tournament) {
                    $tourPoint = 0;
                    foreach($tournament->matches as $ma){
                        $sumOfPoints = 0;
                        $userMatch = MatchUser::where('match_id',$ma->match_id)->where('user_id',$user->id)->get();
                        foreach($userMatch as $recs){
                            $sumOfPoints = $sumOfPoints + $recs->points;
                        }
                        $tourPoint = $tourPoint + $sumOfPoints;
                    }
                    $user_points = $user_points + $tourPoint;
            }
            $boxfight_winnings = BoxMatchResult::getboxwinnings($user->id, $gameId);
            $data[$key]['winnings'] = $user_winnings + $boxfight_winnings;
            $data[$key]['points'] = $user_points;
            $data[$key]['user'] = $user;
        }
        return $data;
    }


    public static function getTopPlayerwinnings($user)
    {
        $user_winnings = 0;
        $matchResults = self::where('user_id', $user->id)->get();

        foreach ($matchResults as $matchResult) {
            $user_winnings = $user_winnings + $matchResult->winning;
        }
        return $user_winnings;
    }

    public static function getTopPlayerPoints($user)
    {
        $user_points = 0;
        $matchResults = self::where('user_id', $user->id)->get();

        foreach ($matchResults as $matchResult) {
            $user_points = $user_points + $matchResult->points;
        }
        return $user_points;
    }
}
