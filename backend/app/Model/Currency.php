<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Currency
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    //
}
