<?php

namespace App\Model;

use App\Model\BaseModel as Model;
use App\Model\File;
use App\Service\S3Service;
use Illuminate\Database\Eloquent\{
    Builder
};

/**
 * App\Model\Match
 *
 * @property int $match_id
 * @property string $type
 * @property string $title
 * @property int|null $winner_id
 * @property string $status
 * @property int|null $hosted_by
 * @property int $tournament_id
 * @property string|null $e_image1
 * @property string|null $e_image2
 * @property string|null $e_video1
 * @property string|null $e_video2
 * @property int $close_for1
 * @property int $close_for2
 * @property int|null $round
 * @property int|null $parent_1
 * @property int|null $parent_2
 * @property int|null $team_1
 * @property int|null $team_2
 * @property \Illuminate\Support\Carbon $start_at
 * @property int $is_final
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\User[] $players
 * @property-read int|null $players_count
 * @property-read int|null $results_count
 * @property-read \App\Model\Team|null $teamA
 * @property-read \App\Model\Team|null $teamB
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \App\Model\Tournament $tournament
 * @property-read \App\Model\Team|null $winnerTeam
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereCloseFor1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereCloseFor2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereEImage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereEImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereEVideo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereEVideo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereHostedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereIsFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereParent1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereParent2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereTeam1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereTeam2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereWinnerId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property string $result_1
 * @property string $result_2
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereResult1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereResult2($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\MatchUser[] $usersMatch
 * @property-read int|null $users_match_count
 * @property-read \App\Model\Status|null $currentStatus
 * @property-read int|null $match_teams_count
 * @property-read int|null $status_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\MatchTeam[] $winner
 * @property-read int|null $winner_count
 * @property int $status_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Match whereStatusId($value)
 */
class Match extends Model
{

    protected $table = 'matches';
    protected $primaryKey = 'match_id';
    protected $dates = [
        'created_at',
        'updated_at',
        'start_at',
        'end_at_min',
        'end_at_max',
        'conflict_end_at'
    ];

    /**
     * @return MatchTeam|null
     */
    public function winnerTeam()
    {
        $highestPlace = $this->teams()->min('place');
        $winners = $this->teams()->where('place', $highestPlace)->orderBy('place','asc');

        if ($winners->count() === 1) {
            return $winners->first();
        }

        return null;
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function hostUser()
    {
        return $this->hasOne(User::class,'id','hosted_by');
    }

    public function hostTeam()
    {
        $hostId = $this->hosted_by;

        if (!$hostId) {
            return null;
        }

        return $this->teams()->whereHas('members',
            function (Builder $q) use ($hostId) {
                $q->where('users.id',$hostId);
            })->first();
    }

    public function teams()
    {
        return $this->hasManyThrough(
            Team::class,
            MatchTeam::class,
            'match_id',
            'team_id',
            'match_id',
            'team_id'
        );
    }

    public function itemsMatchTeams()
    {
        return $this->hasMany(MatchTeam::class, 'match_id');
    }

    public function players()
    {
        return $this->hasManyThrough(User::class, MatchUser::class, 'match_id','id','match_id','user_id');
    }

    public function usersMatch()
    {
        return $this->hasMany(MatchUser::class,'match_id','match_id');
    }

    /**
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|null
     */
    public function parents(){
        $parentRound = $this->round - 1;
        $tournamentId = $this->tournament_id;
        $teamsIds = $this->teams->pluck('team_id')->toArray();

        if ($parentRound <= 0) {
            return null;
        }

        return Match::where('round',$parentRound)
            ->where('tournament_id',$tournamentId)
            ->whereHas('teams',
                function (Builder $q) use ($teamsIds) {
                    $q->whereIn('teams.team_id',$teamsIds);
                })->get();
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function randomWinner()
    {
        $teams = MatchTeam::where('match_id', $this->match_id)->inRandomOrder()->get();
        foreach ($teams as $key => $matchTeam) {
            $matchTeam->place = $key + 1;
            $matchTeam->save();
        }
        $this->status_id = Status::getIdByMatchType('ended');
        $this->save();
    }

    /**
     * @param $user
     * @return bool|Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function getMatchTeamByUser($user)
    {
        $team = $this->teams()->whereHas('members', function ($query) use ($user) {
            $query->where(['users.id' => $user->id]);
        })->first();

        if (!$team) {
            return false;
        }

        $matchTeam = MatchTeam::where('match_id', $this->match_id)
            ->where('team_id',$team->team_id)
            ->first();

        if (!$matchTeam) {
            return false;
        }

        return $matchTeam;
    }

    /**
     * @param $matchTeam
     * @param $data
     * @return bool
     */
    public function uploadEvidence($matchTeam, $data)
    {
        $evidence = Evidence::create([
            'match_team_id' => $matchTeam->id,
            'data' => [
                'kills' => $data['kills'],
                'assists' => $data['assists'],
            ]
        ]);
        $prefix = config('services.awsurl.url');

        foreach ($data['files'] as $file) {
            $mime = $file->getClientMimeType();
            $path = S3Service::uploadFile('evidence', $file, $this->match_id);

            if ($path) {
                $file = File::create([
                    'uri' => $prefix.$path,
                    'mime' => $mime
                ]);
                $evidence->files()->attach($file);
            }
        }

        return true;
    }
}
