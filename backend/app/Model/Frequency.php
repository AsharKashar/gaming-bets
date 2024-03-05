<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Frequency
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Frequency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Frequency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Frequency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Frequency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Frequency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Frequency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Frequency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Frequency extends Model
{
    protected $fillable = [
        'name'
    ];
}
