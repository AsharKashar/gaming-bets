<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TournamentResult
 *
 * @property int $id
 * @property int $tournament_id
 * @property int $first_place
 * @property int $second_place
 * @property int $third_place
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\User $first
 * @property-read \App\Model\User $second
 * @property-read \App\Model\User $third
 * @property-read \App\Model\Tournament $tournament
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult whereFirstPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult whereSecondPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult whereThirdPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TournamentResult whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TournamentResult extends Model
{

    protected $table = "tournament_results";

    protected $guarded = [];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function first()
    {
        return $this->belongsTo(User::class, 'first_place');
    }

    public function second()
    {
        return $this->belongsTo(User::class, 'second_place');
    }

    public function third()
    {
        return $this->belongsTo(User::class, 'third_place');
    }

    public static function addUpdateResult($tournament, $data)
    {
        $tournament_id = $tournament->id;
        $results = $tournament->results;
        if ($results) {
            self::where('id', $results->id)->update(
                [
                    "first_place" => $data['first_place'],
                    "second_place" => $data['second_place'],
                    "third_place" => $data['third_place'],
                ]
            );

            UserPoint::where("tournament_id", $tournament_id)->delete();
            $team1 = Team::findorfail($data['first_place']);
            if ($team1 && $team1->members->count() > 0) {
                $prizePerPerson = $tournament->first_prize / $team1->members->count();
                $pointPerPerson = $tournament->first_points / $team1->members->count();
                foreach ($team1->members as $member) {
                    UserPoint::create(
                        [
                            "user_id" => $member->id,
                            "tournament_id" => $tournament_id,
                            "points" => $pointPerPerson,
                            "winning" => $prizePerPerson,
                        ]
                    );
                }
            }


            $team2 = Team::findorfail($data['second_place']);
            if ($team2 && $team2->members->count() > 0) {
                $prizePerPerson = $tournament->second_prize / $team1->members->count();
                $pointPerPerson = $tournament->second_points / $team1->members->count();
                foreach ($team2->members as $member) {
                    UserPoint::create(
                        [
                            "user_id" => $member->id,
                            "tournament_id" => $tournament_id,
                            "points" => $pointPerPerson,
                            "winning" => $prizePerPerson,
                        ]
                    );
                }
            }

            $team3 = Team::findorfail($data['third_place']);
            if ($team3 && $team3->members->count() > 0) {
                $prizePerPerson = $tournament->third_prize / $team1->members->count();
                $pointPerPerson = $tournament->third_points / $team1->members->count();
                foreach ($team2->members as $member) {
                    UserPoint::create(
                        [
                            "user_id" => $member->id,
                            "tournament_id" => $tournament_id,
                            "points" => $pointPerPerson,
                            "winning" => $prizePerPerson,
                        ]
                    );
                }
            }

            return true;
        } else {
            self::create(
                [
                    "tournament_id" => $tournament_id,
                    "first_place" => $data['first_place'],
                    "second_place" => $data['second_place'],
                    "third_place" => $data['third_place'],
                ]
            );

            $team1 = Team::findorfail($data['first_place']);
            if ($team1 && $team1->members->count() > 0) {
                $prizePerPerson = $tournament->first_prize / $team1->members->count();
                $pointPerPerson = $tournament->first_points / $team1->members->count();
                foreach ($team1->members as $member) {
                    UserPoint::create(
                        [
                            "user_id" => $member->id,
                            "tournament_id" => $tournament_id,
                            "points" => $pointPerPerson,
                            "winning" => $prizePerPerson,
                        ]
                    );
                }
            }


            $team2 = Team::findorfail($data['second_place']);
            if ($team2 && $team2->members->count() > 0) {
                $prizePerPerson = $tournament->second_prize / $team1->members->count();
                $pointPerPerson = $tournament->second_points / $team1->members->count();
                foreach ($team2->members as $member) {
                    UserPoint::create(
                        [
                            "user_id" => $member->id,
                            "tournament_id" => $tournament_id,
                            "points" => $pointPerPerson,
                            "winning" => $prizePerPerson,
                        ]
                    );
                }
            }

            $team3 = Team::findorfail($data['third_place']);
            if ($team3 && $team3->members->count() > 0) {
                $prizePerPerson = $tournament->third_prize / $team1->members->count();
                $pointPerPerson = $tournament->third_points / $team1->members->count();
                foreach ($team2->members as $member) {
                    UserPoint::create(
                        [
                            "user_id" => $member->id,
                            "tournament_id" => $tournament_id,
                            "points" => $pointPerPerson,
                            "winning" => $prizePerPerson,
                        ]
                    );
                }
            }
            return true;
        }
    }


}
