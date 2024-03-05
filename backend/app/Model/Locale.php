<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Locale
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Locale onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Locale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Locale withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Locale withoutTrashed()
 * @mixin \Eloquent
 */
class Locale extends Model
{
    use SoftDeletes;

    //
}
