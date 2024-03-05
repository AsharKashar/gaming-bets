<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Region
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BoxMatches[] $boxmatches
 * @property-read int|null $boxmatches_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tournament[] $tournaments
 * @property-read int|null $tournaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Region whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Region extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'tournament_to_regions');
    }

    public function boxmatches()
    {
        return $this->hasMany(BoxMatches::class, 'region_id');
    }
}
