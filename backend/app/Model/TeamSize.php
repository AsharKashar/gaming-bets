<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TeamSize
 *
 * @property int $id
 * @property string $name
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\GameType[] $gameTypes
 * @property-read int|null $game_types_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamSize whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamSize whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TeamSize whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TeamSize extends Model
{
    protected $fillable = [
        'name',
        'size'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function gameTypes()
    {
        return $this->hasMany(GameType::class);
    }
}
