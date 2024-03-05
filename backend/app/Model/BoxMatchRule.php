<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\BoxMatchRule
 *
 * @property int $id
 * @property int $game_id
 * @property string $rule
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatchRule onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule whereRule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatchRule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatchRule withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatchRule withoutTrashed()
 * @mixin \Eloquent
 */
class BoxMatchRule extends Model
{
    use SoftDeletes;

    //
    protected $casts = [
        'rule' => 'array',
    ];
    protected $dates = ['deleted_at'];

    public static function getGameRule($game_id)
    {
        $rules = self::where('game_id', $game_id)->get();
        return $rules;
    }
}
