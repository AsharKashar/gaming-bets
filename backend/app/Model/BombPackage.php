<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\BombPackage
 *
 * @property int $id
 * @property string|null $title
 * @property mixed|null $description
 * @property int $bombs
 * @property int $free_bombs
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BombPackage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage whereBombs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage whereFreeBombs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombPackage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BombPackage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BombPackage withoutTrashed()
 * @mixin \Eloquent
 */
class BombPackage extends Model
{
    use SoftDeletes;

    //
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'bombs',
        'free_bombs',
        'price'
    ];

    public static function getPackage($id)
    {
        $data = BombPackage::find($id);
        return $data;
    }

    public function getDescriptionAttribute($description)
    {
        return json_decode($description, true) ?: [];
    }

    public function setDescriptionAttribute($description)
    {
        if (is_array($description)) {
            $this->attributes['description'] = json_encode($description);
        }
    }

}
