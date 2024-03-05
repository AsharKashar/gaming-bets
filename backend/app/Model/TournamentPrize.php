<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TournamentPrize
 *
 * @property int $id
 * @property int|null $team_id
 * @property int $tournament_id
 * @property string $position
 * @property float $prize
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $point
 * @property-read \App\Model\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize wherePrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentPrize whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TournamentPrize extends Model
{

    protected $primaryKey = 'id';
    protected $table = "tournament_prizes";

    protected $fillable = [
        'point',
        'position',
        'prize',
        'tournament_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }

    public static function addWinner($tournament, $winner, $position)
    {
        $result = false;
        $team = Team::findorfail($winner);

        $prize = TournamentPrize::where('tournament_id', $tournament)->where('position', $position)->first();

        if ($prize) {
            $prize->team_id = $team->team_id;
            $prize->save();
            $result = true;

            if ($team && $team->members->count() > 0) {
                $prizePerPerson = $prize->prize / $team->members->count();
                $pointPerPerson = $prize->point / $team->members->count();
                foreach ($team->members as $member) {
                    UserPoint::create(
                        [
                            "user_id" => $member->id,
                            "tournament_id" => $tournament,
                            "points" => $pointPerPerson,
                            "winning" => $prizePerPerson,
                        ]
                    );
                }
            }
        }


        return $result;
    }


}
