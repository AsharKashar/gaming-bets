<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Settings
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Settings whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Settings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Settings whereValue($value)
 * @mixin \Eloquent
 */
class Settings extends Model
{
    //
}
