<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\MatchLimit
 *
 * @property int $id
 * @property int $min
 * @property int $max
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchLimit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchLimit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchLimit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchLimit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchLimit whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchLimit whereMin($value)
 * @mixin \Eloquent
 */
class MatchLimit extends Model
{
    public $timestamps = false;

    public $fillable = [
        'min',
        'max'
    ];
}
