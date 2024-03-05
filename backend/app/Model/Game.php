<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * App\Model\Game
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $cover
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\GameRules[] $rules
 * @property-read int|null $rules_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $tag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\GameMode[] $gameModes
 * @property-read int|null $game_modes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\GamePlatform[] $gamePlatforms
 * @property-read int|null $game_platforms_count
 * @property-read string $cover_public_url
 * @property-read string $image_public_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TournamentSize[] $tournamentSizes
 * @property-read int|null $tournament_sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tournament[] $tournaments
 * @property-read int|null $tournaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Game whereTag($value)
 */
class Game extends Model
{

    protected $appends = [
        'cover_public_url',
        'image_public_url',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gameModes()
    {
        return $this->hasMany(GameMode::class, 'game_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tournamentSizes()
    {
        return $this->hasMany(TournamentSize::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function gamePlatforms()
    {
        return $this->belongsToMany(GamePlatform::class, 'game_to_game_platform');
    }


    /**
     * @param  Request  $request
     * @param $name
     * @return bool|string|void
     */
    public static function saveImage(Request $request, $name)
    {
        if (!$request->file($name)) {
            return;
        }
        $imagePath = 'games/'.time().'.'.$request->{$name}->getClientOriginalExtension();
        $image = Image::make($request->file($name));
        if (Storage::disk('s3')->put($imagePath, $image->stream())) {
            return $imagePath;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getCoverPublicUrlAttribute()
    {
        $cover = $this->cover;
        return str_contains($cover, 'https://') ? $cover : config('services.environment.url').$cover;
    }

    /**
     * @return string
     */
    public function getImagePublicUrlAttribute()
    {
        $image = $this->image;
        return str_contains($image, 'https://') ? $image : config('services.environment.url').$image;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }

    public static function checkGames($game_id)
    {
        $data = self::find($game_id);
        if (!$data) {
            return false;
        }
        return true;
    }

}
