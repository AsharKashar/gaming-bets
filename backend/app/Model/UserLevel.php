<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserLevel
 *
 * @property int $id
 * @property string $name
 * @property int $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserLevel wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserLevel extends Model
{
    protected $fillable = [
        'name',
        'points'
    ];

    /**
     * @param $points
     * @return mixed
     */
    public static function getNearestLevel($points){
        return UserLevel::where('points','<=',$points)->latest('points')->first();
    }
}
