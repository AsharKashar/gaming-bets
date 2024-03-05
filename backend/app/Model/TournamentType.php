<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TournamentType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TournamentType extends Model
{
    protected $fillable = [
        'name'
    ];
}
