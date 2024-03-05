<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\MatchType
 *
 * @property int $id
 * @property string $name
 * @property string|null $preview_img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchType wherePreviewImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchType onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchType withoutTrashed()
 */
class MatchType extends Model
{
    protected $fillable = [
        'name',
        'preview_img'
    ];


    public static function checkTheMatchTypeValue($match_type)
    {
        $data = self::find($match_type);
        if (!$data) {
            return false;
        }
        return true;
    }
}
