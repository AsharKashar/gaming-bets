<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserGameStatistic
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $total_points_earned
 * @property int $total_bombs_earned
 * @property float $win_loss_record
 * @property float $win_ratio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereTotalBombsEarned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereTotalPointsEarned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereWinLossRecord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserGameStatistic whereWinRatio($value)
 * @mixin \Eloquent
 */
class UserGameStatistic extends Model
{
    protected $table = "user_game_statistic";
    protected $primaryKey = "id";


    public static function getStatistic($id, $game_id = 1)
    {
        $game = Game::where('id', $game_id)->first();

        $statistic = self::where('user_id', $id)->where('game_id', $game_id)->first();
        if (isset($statistic->id)) {
            $statistic['game'] = $game->name;
            $statistic['game_image'] = $game->image;
            $statistic['game_cover'] = $game->cover;
            return $statistic;
        }
        $statistic['game'] = $game->name;
        $statistic['game_image'] = $game->image;
        $statistic['game_cover'] = $game->cover;
        return $statistic;
    }
}
