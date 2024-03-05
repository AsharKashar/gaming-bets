<?php
namespace App\Relations;

use App\Model\TournamentsUser;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Relations\TeamTournamentRelation
 *
 * @property int $id
 * @property int $team_id
 * @property int $tournament_id
 * @property int $allowed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation whereAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_valid
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamTournamentRelation whereIsValid($value)
 */
class TeamTournamentRelation extends Model
{
    protected $table = "team_tournament";
    protected $fillable = ['team_id', 'tournament_id'];

    public static function joinDuo($tournament_id, $team_id)
    {
        $add = new self();
        $add->team_id = $team_id;
        $add->tournament_id = $tournament_id;
        $add->save();
        return true;
    }

    public static function joinSquad($tournament_id, $team_id)
    {
        $add = new self();
        $add->team_id = $team_id;
        $add->tournament_id = $tournament_id;
        $add->save();
        return true;
    }

    public static function getTournamentRelations($teams)
    {
        $TournamentRelations = [];
        foreach ($teams as $team) {
            $TournamentRelations[] = self::where('team_id', $team->id);
        }
        return $TournamentRelations;
    }
}
