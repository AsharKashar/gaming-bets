<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\MatchReport
 *
 * @property int $id
 * @property int $user_id
 * @property int $match_id
 * @property string $topic
 * @property string $description
 * @property string|null $file_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport whereTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MatchReport whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchReport onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchReport withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\MatchReport withoutTrashed()
 */
class MatchReport extends Model
{
    //
}
