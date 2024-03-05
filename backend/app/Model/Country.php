<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Country query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $code
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Country whereName($value)
 */
class Country extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'code'
    ];

    public static function getDefaultCountryId()
    {
        return self::firstWhere('code', 'ESP')->id;
    }
}
