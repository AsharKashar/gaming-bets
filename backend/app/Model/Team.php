<?php

namespace App\Model;

use App\Relations\TeamTournamentRelation;
use App\Relations\TeamUserRelation;
use App\Service\S3Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\{Builder};
use Illuminate\Http\UploadedFile;

/**
 * App\Model\Team
 *
 * @property int $team_id
 * @property int $owner_id
 * @property int $game_id
 * @property string $name
 * @property string $avatar_key
 * @property int $size
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $checked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\User[] $members
 * @property-read int|null $members_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereChecked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $team_size_id
 * @property-read string $avatar_url
 * @property-read mixed $member_size
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TeamInvite[] $invitations
 * @property-read int|null $invitations_count
 * @property-read \App\Model\User|null $owner
 * @property-read \App\Model\TeamSize $sizes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tournament[] $teamTournament
 * @property-read int|null $team_tournament_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team forCurrentUser()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereAvatarKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereTeamSizeId($value)
 * @property int $current_rank
 * @property int $total_rank
 * @property int $total_win
 * @property int $points_earned
 * @property float $win_ratio
 * @property int $team_list
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereCurrentRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team wherePointsEarned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereTeamList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereTotalRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereTotalWin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereWinRatio($value)
 */
class Team extends Model
{

    protected $table = "teams";
    protected $primaryKey = "team_id";
    protected $guarded = [];
    protected $fillable = [
        'name',
        'team_size_id',
        'avatar_key',
        'game_id',
        'owner_id'
    ];

    protected $appends = [
        'avatar_url',
        'member_size',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'team_user_relation', 'team_id', 'user_id')->withPivot(
            ['checked_in', 'activision', 'is_leader']
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sizes()
    {
        return $this->belongsTo(TeamSize::class, 'team_size_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations()
    {
        return $this->hasMany(TeamInvite::class, 'team_id', 'team_id');
    }

    public function teamTournament()
    {
        return $this->belongsToMany(Tournament::class, 'team_tournament', 'team_id', 'tournament_id');
    }

    /**
     * @param $data
     * @return TeamUserRelation|Model
     */
    public static function joinTeam($data)
    {
        return TeamUserRelation::create(
            [
                'team_id' => $data['team_id'],
                'user_id' => $data['user_id'],
                'is_leader' => $data['leader'] ?? 0,
                'activision' => $data['activision']
            ]
        );
    }


    /**
     * @param $user
     * @param  array  $props
     * @return TeamUserRelation|Model
     */
    public function addMember($user, $props = [])
    {
        $existMember = TeamUserRelation::where('user_id', $user->id)
            ->where('team_id', $this->team_id)
            ->first();

        if ($existMember) {
            return $existMember;
        }

        $member = TeamUserRelation::create([
            'team_id' => $this->team_id,
            'user_id' => $user->id,
            'is_leader' => $props['is_leader'] ?? false,
            'checked_in' => $props['checked_in'] ?? false,
            'activision' => ''
        ]);

        if ($member) {
            optional(TeamInvite::firstWhere(['team_id' => $this->team_id, 'user_id' => $user->id]))->delete();
        }

        return $member;
    }

    /**
     * @param $team_id
     * @return mixed
     */
    public static function disbandTeam($team_id)
    {
        TeamUserRelation::where('team_id', $team_id)->delete();
        return self::where('team_id', $team_id)->delete();
    }

    /**
     * @param $team_id
     * @return mixed
     */
    public static function leaveTeam($team_id)
    {
        return TeamUserRelation::where('team_id', $team_id)->where('user_id', auth()->id())->delete();
    }

    /**
     * @param $team_id
     * @param $member_id
     * @return mixed
     */
    public static function kickOutMember($team_id, $member_id)
    {
        return TeamUserRelation::where('team_id', $team_id)->where('user_id', $member_id)->delete();
    }

    /**
     * @param $tournament_id
     */
    public function addTournamentRelation($tournament_id)
    {
        TeamTournamentRelation::create(
            [
                'team_id' => $this->team_id,
                'tournament_id' => $tournament_id,
            ]
        );
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeForCurrentUser($query)
    {
        $userId = optional(auth()->user())->id;

        if ($userId) {
            return $query->whereHas(
                'members',
                function (Builder $q) use ($userId) {
                    $q->where('users.id', $userId);
                }
            );
        }

        return $query;
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        return config('filesystems.disks.s3.url').$this->avatar_key;
    }

    public function getMemberSizeAttribute()
    {
        return TeamUserRelation::where('team_id', $this->team_id)->get()->count();
    }

    public static function createNewTeam(array $data, UploadedFile $avatar = null)
    {
        $team = new self();
        $team->name = $data['name'];
        $team->team_size_id = $data['team_size_id'];
        $team->game_id = $data['game_id'];
        $team->owner_id = $data['owner_id'] ?? auth()->user()->id;
        $team->save();

        return $team;
    }
}
