<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\GameMode
 *
 * @property int $id
 * @property string $name
 * @property string $tag
 * @property int $game_id
 * @property int $match_limits_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $preview_img
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\GameType[] $gameTypes
 * @property-read int|null $game_types_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Game[] $games
 * @property-read int|null $games_count
 * @property-read mixed|string $preview_image_url
 * @property-read \App\Model\MatchLimit|null $matchLimits
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode whereMatchLimitsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode wherePreviewImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameMode whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\GameModeRules[] $rules
 * @property-read int|null $rules_count
 */
class GameMode extends Model
{
    protected $fillable = [
        'name',
        'preview_img',
        'tag',
        'match_limits_id'
    ];

    protected $with = [
        'gameTypes'
    ];

    protected $appends = [
        'preview_image_url',
        'tournament_count'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function games()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gameTypes()
    {
        return $this->hasMany(GameType::class, 'game_mode_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function matchLimits()
    {
        return $this->hasOne(MatchLimit::class,'id','match_limits_id');
    }

    public function rules()
    {
        return $this->hasMany(GameModeRules::class);
    }


    /**
     * @return mixed|string
     */
    public function getPreviewImageUrlAttribute()
    {
        $image = $this->preview_img;
        if (!$image) {
            return '';
        }
        return str_contains($image, 'https://') ? $image : config('services.environment.url').$image;
    }

    public function getTournamentCountAttribute()
    {
        return Tournament::where('game_mode_id', $this->id)->count();
    }


    public static function checkTheGameModeValue($game_mode)
    {
        $data = self::find($game_mode);
        if (!$data) {
            return false;
        }

        return true;
    }
}
