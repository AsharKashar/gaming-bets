<?php

namespace App\Model;

use App\Service\CommonFiveVsFiveService;
use App\Service\FortnitePrizePoolService;
use App\Service\TournamentTeamsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Tournament
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $game_id
 * @property int $entry_fee
 * @property \Illuminate\Support\Carbon|null $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property \Illuminate\Support\Carbon|null $reg_start_at
 * @property \Illuminate\Support\Carbon|null $reg_end_at
 * @property string|null $image
 * @property float $first_prize
 * @property float $second_prize
 * @property float $third_prize
 * @property float $first_points
 * @property float $second_points
 * @property float $third_points
 * @property int $platform_type_id
 * @property string|null $hosted_by
 * @property string $status
 * @property int $game_type_id
 * @property int $game_mode_id
 * @property string|null $bracket_size
 * @property string|null $bracket_type
 * @property string|null $team_size
 * @property string|null $regions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property string|null $check_in
 * @property string|null $kickoff_in
 * @property int|null $top_players
 * @property int|null $per_match
 * @property int $rounds_finished
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property string|null $repeat
 * @property int|null $featured
 * @mixin \Eloquent
 * @property string|null $overview
 * @property int|null $tournament_size_id
 * @property int|null $entry_fee_id
 * @property int $status_id
 * @property int $frequency_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Team[] $check_teams
 * @property-read int|null $check_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Team[] $disqualified_teams
 * @property-read int|null $disqualified_teams_count
 * @property-read \App\Model\EntryFee|null $entryFeeItem
 * @property-read \App\Model\Frequency|null $frequency
 * @property-read \App\Model\Game $game
 * @property-read \App\Model\GameMode|null $gameMode
 * @property-read \App\Model\GameType|null $gameType
 * @property-read null|string $formated_start
 * @property-read null|string $image_url
 * @property-read mixed $max_team
 * @property-read mixed $tournament_size
 * @property-read mixed $user_joined
 * @property-read \App\Model\MatchLimit|null $matchLimits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Match[] $matches
 * @property-read int|null $matches_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\GamePlatform[] $platforms
 * @property-read int|null $platforms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TournamentPrize[] $prizes
 * @property-read int|null $prizes_count
 * @property-read int|null $regions_count
 * @property-read \App\Model\TournamentResult|null $results
 * @property-read int|null $rules_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TournamentPrize[] $teamResults
 * @property-read int|null $team_results_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TeamTournamentUser[] $teamTournamentUsers
 * @property-read int|null $team_tournament_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \App\Model\TournamentSize|null $tournamentSizeItem
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereCheckIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereEntryFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereFrequencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereGameModeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereGameTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereHostedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereKickoffIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereRegEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereRegStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereTournamentSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tournament whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\GameModeRules[] $gameModeRules
 * @property-read int|null $game_mode_rules_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TournamentOptions[] $options
 * @property-read int|null $options_count
 */
class Tournament extends Model
{

    protected $table = "tournaments";
    protected $primaryKey = "id";
    protected $dates = [
        "created_at",
        "updated_at",
        "start_at",
        "end_at",
        "reg_start_at",
        "reg_end_at",
    ];
    protected $fillable = [
        'name',
        'description',
        'image',
        'overview',
        'hosted_by',
        'tournament_size_id',
        'entry_fee_id',
        'status_id',
        'frequency_id',
        'game_mode_id',
        'game_id',
        'game_type_id',
        'featured',
    ];

    protected $appends = [
        'image_url',
        'formated_start',
        'team_size',
        'entry_fee',
        'tournament_size',
        'user_joined'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'featured' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function teamTournamentUsers()
    {
        return $this->hasManyThrough(TeamTournamentUser::class, TeamTournament::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function frequency()
    {
        return $this->hasOne(Frequency::class, 'id', 'frequency_id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function players()
    {
        $usersIds = $this->teamTournamentUsers->pluck('user_id')->toArray();
        $users = User::whereIn('id', $usersIds)->get();

        return $users;
    }

    public function options()
    {
        return $this->hasMany(TournamentOptions::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_tournament', 'tournament_id', 'team_id')
            ->withPivot(['is_valid']);
    }

    public function rounds()
    {
        return $this->matches()
            ->groupBy('round')
            ->select('round')
            ->pluck('round')
            ->toArray();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function platforms()
    {
        return $this->belongsToMany(GamePlatform::class, 'tournament_to_game_platform');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prizes()
    {
        return $this->hasMany(TournamentPrize::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function regions()
    {
        return $this->belongsToMany(Region::class, 'tournament_to_regions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function results()
    {
        return $this->hasOne(TournamentResult::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gameType()
    {
        return $this->hasOne(GameType::class, 'id', 'game_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameMode()
    {
        return $this->belongsTo(GameMode::class, 'game_mode_id', 'id');
    }

    public function gameModeRules()
    {
        return $this->hasManyThrough(GameModeRules::class,GameMode::class, 'id', 'game_mode_id', 'game_mode_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamResults()
    {
        return $this->hasMany(TournamentPrize::class, 'tournament_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matches()
    {
        return $this->hasMany(Match::class, 'tournament_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function entryFeeItem()
    {
        return $this->hasOne(EntryFee::class, 'id', 'entry_fee_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tournamentSizeItem()
    {
        return $this->hasOne(TournamentSize::class, 'id', 'tournament_size_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * @return array
     */
    public function getMatches()
    {
        return auth()->check() ? auth()->user()->userTeamMatches($this->id) : [];
    }


    /**
     * @param $mode
     * @param $type
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getGameWithMode($mode, $type)
    {
        $matches = self::where('game_mode_id', $mode)->where('game_type_id', $type)->with('matches')->get();
        return $matches;
    }

    /**
     * @param  Game  $game
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getallgames($gameid)
    {
        return self::where('game_id', $gameid);
    }

    /**
     * @param $id
     */
    private static function updateStatus($id)
    {
        $tournament = self::find($id);
        $tournament->status = Status::TOURNAMENT_TYPES['started'];
        $tournament->save();
    }

    /**
     * @param $game_id
     * @param $game_mode
     * @param $game_type
     * @param $platform
     * @param $heild_on
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function tournamentFilter($game_id, $game_mode, $game_type, $platform, $heild_on)
    {
        $tournament = self::where('game_id', 'LIKE', $game_id)
            ->where('match_type', 'LIKE', $game_mode)
            ->where('game_mode', 'LIKE', $game_type)
            ->where('platforms', 'LIKE', $platform)
            ->where('repeat', 'LIKE', $heild_on)
            ->get();

        return $tournament;
    }

    /**
     * @return null|string
     */
    public function getFormatedStartAttribute()
    {
        return strtoupper(date("M d hA", strtotime($this->start_at)));
    }

    /**
     * @return null|string
     */
    public function getImageUrlAttribute()
    {
        $image = $this->image;
        return str_contains($image, 'https://') ? $image : config('services.environment.url').'/'.$image;
    }

    public function getTeamSizeAttribute()
    {
        return $this->gameType->teamSize;
    }

    public function getEntryFeeAttribute()
    {
        return $this->entryFeeItem->fee;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function matchLimits()
    {
        return $this->hasOneThrough(MatchLimit::class, GameMode::class, 'id', 'id', 'game_mode_id', 'match_limits_id');
    }

    public function getTournamentSizeAttribute()
    {
        $tag = $this->game->tag;
        $tournamentSize = $this->tournamentSizeItem->players_count;
        $entryFee = $this->entryFeeItem->fee;
        $teamSize = $this->gameType->teamSize->size;
        $actualCount = $this->teams()->where('team_tournament.is_valid', 1)->count() * $teamSize;
        $result = [
            'players_count' => $tournamentSize,
            'players_actual_count' => $actualCount,
            'teams_count' => $tournamentSize / $teamSize,
            'teams_actual_count' => $actualCount / $teamSize,
        ];

        switch ($tag) {
            case 'fortnite':
                $limits = FortnitePrizePoolService::getTournamentLimits($teamSize, $entryFee, $tournamentSize);
                $result['players_min_count'] = $limits[0];
                $result['players_max_count'] = $limits[1];
                break;
            default:
                $limits = CommonFiveVsFiveService::getTournamentLimits($entryFee, $tournamentSize);
                $result['players_min_count'] = $limits[0];
                $result['players_max_count'] = $limits[1];
                break;
        }

        return $result;
    }

    public function addDemoTeams($teamCount)
    {
        for ($t = 1; $t <= $teamCount; $t++) {
            $teamOwner = User::registerDemoUser(); // create first member of team
            $team = Team::createNewTeam([
                'name' => sprintf(
                    'Team%s',
                    $t
                ),
                'team_size_id' => $this->gameType->teamSize->id,
                'game_id' => $this->game->id,
                'owner_id' => $teamOwner->id
            ]);
            $team->avatar_key = 'teams/128/2020/9/c56a2ae28847b9223ea64c7e9a607cca-1600212304.png';
            $team->save();
            $team->addMember($teamOwner, ['is_leader' => true, 'checked_in' => true]);
            TournamentTeamsService::joinTeam($team, $this, $teamOwner);
            for ($u = 2; $u <= $this->gameType->teamSize->size; $u++) {
                $member = User::registerDemoUser();
                $team->addMember($member, ['is_leader' => false, 'checked_in' => true]);
                TournamentTeamsService::joinTeam($team, $this, $member);
            }

        }
    }

    public function getUserJoinedAttribute()
    {
        $user = auth()->user();

        if ($user) {
            return $this->teamTournamentUsers()->firstWhere(['user_id' => $user->id, 'bomb_payed' => 1]) ?? false;
        }

        return false;
    }

    public function getUserValidTeam($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return false;
        }

        return $this->teams()
            ->whereHas('members', function ($query) use ($userId) {
                $query->where(['users.id' => $userId]);
            })
            ->where('is_valid',1)
            ->first();
    }
}
