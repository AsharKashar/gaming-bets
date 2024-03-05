<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TournamentSize
 *
 * @property int $id
 * @property int $game_id
 * @property int $players_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentSize whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentSize wherePlayersCount($value)
 * @mixin \Eloquent
 */
class TournamentSize extends Model
{
    public $timestamps = false;
}
