<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\GameType
 *
 * @property int $id
 * @property int $team_size_id
 * @property string $name
 * @property string $tag
 * @property int $game_mode_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\GameMode $gameMode
 * @property-read \App\Model\TeamSize $teamSize
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType whereGameModeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType whereTeamSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GameType extends Model
{
    protected $fillable = [
        'name',
        'team_size_id',
        'tag'
    ];

    public static function checkTheGameTypeValue($match_type)
    {
        $data = self::find($match_type);
        if (!$data) {
            return false;
        }
        return true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function teamSize()
    {
        return $this->belongsTo(TeamSize::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameMode()
    {
        return $this->belongsTo(GameMode::class);
    }
}
