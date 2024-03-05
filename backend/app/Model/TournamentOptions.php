<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TournamentOptions
 *
 * @property int $id
 * @property int $tournament_id
 * @property mixed $join_links
 * @property mixed $support_links
 * @property-read \App\Model\Tournament $tournament
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions whereJoinLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions whereSupportLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions whereTournamentId($value)
 * @mixin \Eloquent
 * @property int $locale_id
 * @property string $type
 * @property mixed|null $data
 * @property mixed $stream_links
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions whereLocaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentOptions whereType($value)
 * @property-read \App\Model\Locale $locale
 */
class TournamentOptions extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tournament_id',
        'locale_id',
        'type',
        'data'
    ];

    protected $casts = [
        'data' =>'json',
    ];

    public function locale() {
        return $this->belongsTo(Locale::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function setDataAttribute($values)
    {
        $this->attributes['data'] = json_encode($values);
    }
}
