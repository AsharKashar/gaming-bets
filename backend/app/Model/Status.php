<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Status
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $group
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Status whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Status extends Model
{
    const TOURNAMENT_TYPES = [
        'upcoming' => 'upcoming',
        'registration' => 'registration',
        'full' => 'full', // validate and set full
        'finish_registration' => 'finish_registration', // bracket generation
        'started' => 'started',
        'ended' => 'ended',
        'canceled' => 'canceled',
    ];

    const MATCH_TYPES = [
        'created' => 'created', // auto - evidence
        'teams_added' => 'teams_added', // auto - evidence
        'started' => 'started', // auto - evidence
        'full' => 'full', //
        'live' => 'live', //
        'pending_results' => 'pending_results', // endAtMin < pending_results < endAtMax+10min (Display 'I won'/'I Lost' on FE), If no answer -> random winner
        'conflict' => 'conflict', // 10 minutes after reaching this status(when both teams click same button (I won/ I Lost)). Displays evidence upload botton on FE. If no answer -> random winner
        'ended' => 'ended', // math results fetched -> evidence upload: if no conflicts
        'no_result' => 'no_result',
        'cancelled' => 'cancelled',
    ];

    const GROUPS = [
        'tournament' => 'tournament',
        'match' => 'match'
    ];

    protected $fillable = [
        'name',
        'type',
        'group',
        'order'
    ];

    public static function getIdByTournamentType($type)
    {
        return self::where('group', Status::GROUPS['tournament'])->where('type',
            self::TOURNAMENT_TYPES[$type])->first()->id;
    }

    public static function getIdByMatchType($type)
    {
        return self::where('group', Status::GROUPS['match'])->where('type',
            self::MATCH_TYPES[$type])->first()->id;
    }
}

