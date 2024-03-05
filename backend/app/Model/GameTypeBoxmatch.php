<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\GameTypeBoxmatch
 *
 * @property int $id
 * @property string $description
 * @property int $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BoxMatches[] $boxmatches
 * @property-read int|null $boxmatches_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\GameTypeBoxmatch onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GameTypeBoxmatch whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\GameTypeBoxmatch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\GameTypeBoxmatch withoutTrashed()
 * @mixin \Eloquent
 */
class GameTypeBoxmatch extends Model
{
    use SoftDeletes;

    protected $hidden = ['value', 'created_at', 'updated_at'];

    //
    public function boxmatches()
    {
        return $this->hasMany(BoxMatches::class, 'game_type_boxmatch_id');
    }
}
