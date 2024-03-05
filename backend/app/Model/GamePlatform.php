<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\GamePlatform
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BoxMatches[] $boxmatches
 * @property-read int|null $boxmatches_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Game[] $games
 * @property-read int|null $games_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tournament[] $tournaments
 * @property-read int|null $tournaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GamePlatform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GamePlatform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GamePlatform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GamePlatform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GamePlatform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GamePlatform whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GamePlatform whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GamePlatform whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GamePlatform extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];

    protected $hidden = ['created_at', 'updated_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_to_game_platform');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'tournament_to_game_platform');
    }

    public function boxmatches()
    {
        return $this->belongsToMany(BoxMatches::class, 'platform_id');
    }

    public static function getPlatform($id)
    {
        $data = self::find($id);
        if (!$data) {
            return false;
        }
        return $data->name;
    }
}
