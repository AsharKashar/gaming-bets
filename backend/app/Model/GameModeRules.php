<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\GameModeRules
 *
 * @property int $id
 * @property int $game_mode_id
 * @property int $locale_id
 * @property array $rules
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Locale $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules whereGameModeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules whereLocaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules whereRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property array $data
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameModeRules whereData($value)
 */
class GameModeRules extends Model
{
    protected $fillable = [
        'game_mode_id',
        'locale_id',
        'data'
    ];

    protected $casts = [
        'data' => 'json'
    ];

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }
}
