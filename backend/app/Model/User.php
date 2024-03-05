<?php

namespace App\Model;

use App\Service\StripeService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Model\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int|null $currency_id
 * @property string|null $image
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $stripe_id
 * @property string|null $boxfights_allowed
 * @property string|null $boxfights_renew
 * @property string $user_type
 * @property string|null $admin_type
 * @property string|null $subscribe_qty
 * @property string $country
 * @property string|null $api_token
 * @property-read int|null $awards_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Card[] $cards
 * @property-read int|null $cards_count
 * @property-read mixed $avatar_url
 * @property-read \App\Model\Leaderboard $leaderboard
 * @property-read \App\Model\Membership $membership
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PaymentHistory[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Team[] $teams
 * @property-read int|null $teams_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Model\Tournament[] $tournaments
 * @property-read int|null $tournaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereAdminType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereBoxfightsAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereBoxfightsRenew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereSubscribeQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUsername($value)
 * @mixin \Eloquent
 * @property-read \App\Model\UserBombs|null $bomb
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BoxmatchUser[] $boxMatchUsers
 * @property-read int|null $boxmatch_user_count
 * @property-read mixed $all_bombs
 * @property-read mixed $avatar
 * @property-read mixed $connections
 * @property-read mixed $country_code
 * @property-read mixed $unread_notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\UserConnection[] $socialConnections
 * @property-read int|null $social_connections_count
 * @property int $country_id
 * @property string|null $date_of_birth
 * @property string|null $gender
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereGender($value)
 * @property-read \App\Model\UserLevel|null $level
 * @property-read \App\Model\UserPoint|null $points
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BoxmatchUser[] $boxMatchUser
 * @property-read int|null $box_match_user_count
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    const GENDER = ['Male', 'Female'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'currency_id',
        'user_type',
        'image',
        'bombs',
        'stripe_id',
        'boxfights_allowed',
        'boxfights_renew',
        'country',
        'country_id',
        'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'all_bombs',
        // 'stripe_id',
        // 'boxfights_allowed',
        // 'boxfights_renew',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'avatar_url',
        'connections',
        'unread_notifications_count',
        'all_bombs',
        'country_code'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class, 'user_id');
    }

    public function leaderboard()
    {
        return $this->belongsTo(Leaderboard::class, 'user_id');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'user_id');
    }

    public function boxMatchUser()
    {
        return $this->hasMany(BoxmatchUser::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentHistory::class)->select(
            "tournaments.name as name",
            "payment_histories.pay as amount",
            "payment_histories.created_at as date",
            "bomb"
        )->leftJoin("tournaments", "tournaments.id", "payment_histories.tournament_id");
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user_relation', 'user_id', 'team_id');
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function total_bomb()
    {
        return $this->all_bombs;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function bomb()
    {
        return $this->hasOne(UserBombs::class);
    }

    protected static function uploadImage()
    {
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(storage_path('app/public/profiles/'), $imageName);
        return "profiles/".$imageName;
    }

    public function points()
    {
        return $this->hasOne(UserPoint::class);
    }

    public static function addFreeBoxfightsMonthly()
    {
        $users = self::where('user_type', 'user')->get();
        foreach ($users as $user) {
            if ($user->boxfights_renew) {
                if (Carbon::parse($user->boxfights_renew)->diffInMonths() >= 1) {
                    $user->boxfights_renew = Carbon::now();
                    $user->boxfights_allowed = 10;
                    $user->save();
                }
            }
        }
    }

    public static function selectTopThree($usersWithResults)
    {
        $usersWithResults = collect($usersWithResults);
        $return = $usersWithResults->sortByDesc('winnings');
        return $return->take(3);
    }

    public static function sortUsers($usersWithResults)
    {
        $usersWithResults = collect($usersWithResults);
        $return = $usersWithResults->sortByDesc('points');
        $res = [];
        foreach ($return  as $key => $value) {
            $res[] = $value;
        }
        return $res;
    }

    public static function getUserStripeId($id)
    {
        $user = self::find($id);
        $stripe = $user->stripe_id;
        return $stripe;
    }

    public function getAvatarUrlAttribute()
    {
        $image = $this->image;
        if (!$image) {
            return null;
        }
        return str_contains($image, 'https://') ? $image : config('filesystems.disks.s3.url').$image;
    }

    public function socialConnections()
    {
        return $this->hasMany(UserConnection::class);
    }

    public function updateConnection($serviceType, $serviceInfo)
    {
        $connection = $this->socialConnections()->where('service_type', $serviceType)->first();

        if (!$connection) {
            UserConnection::create(
                [
                    'user_id' => $this->id,
                    'service_type' => $serviceType,
                    'service_info' => $serviceInfo
                ]
            );
        } else {
            $connection->service_info = $serviceInfo;
            $connection->save();
        }
    }

    public function getConnectionsAttribute()
    {
        $socialConnections = $this->socialConnections()->get();
        $connections = [];

        foreach ($socialConnections as $connection) {
            $connections[$connection->service_type] = $connection->service_info;
        }

        return $connections;
    }

    public function getAvatarAttribute()
    {
        return config('filesystems.disks.s3.url').$this->image;
    }

    public function getCountryCodeAttribute() {
        if ($country = $this->country) {
            return $country->code;
        } else {
            return '';
        }
    }

    public function getUnreadNotificationsCountAttribute()
    {
        return $this->notifications()->where('read', false)->count();
    }

    public function getAllBombsAttribute()
    {
        if (!$this->bomb) {
            return;
        }
        return $this->bomb->bombs_total;
    }

    /**
     * @param  array  $data
     * @return User
     */
    public static function registerNewUser(array $data): self
    {
        $user = new self();
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->name = $data['name'];
        $user->user_type = 'user';
        $user->username = $data['username'];
        $user->country_id = $data['country_id'];
        $user->gender = $data['gender'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->stripe_id = $data['stripe_customer_id'];
        $user->boxfights_allowed = 10;
        $user->boxfights_renew = Carbon::now();
        $user->save();

        return $user;
    }

    public static function registerDemoUser()
    {
        $country = Country::firstWhere('name', 'Spain');
        $microTime = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());

        $user = self::registerNewUser([
            'email' => sprintf('banger+%s@bangergames.com', $microTime),
            'password' => 'banger2020',
            'name' => 'Demo',
            'username' => sprintf('demo%s', $microTime),
            'country_id' => $country->id,
            'gender' => 'Male',
            'date_of_birth' => '28/07/1988',
            'stripe_customer_id' => null,
        ]);
        $user->name = sprintf('Demo %s', $user->id);
        $user->save();

        return $user;
    }

    /**
     * @param $pointsToAdd
     */
    public function addPoints($pointsToAdd){
        $points = $this->points;

        if (!$points) {
            $points = UserPoint::create([
                'user_id' => $this->id,
                'points' => 0
            ]);
        }

        $updatedValue = $points->points + $pointsToAdd;
        $userLevelId = UserLevel::getNearestLevel($updatedValue)->id;

        $this->points()->update([
            'points' => $updatedValue,
            'user_level_id' => $userLevelId
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function level() {
        return $this->hasOneThrough(UserLevel::class,UserPoint::class,'id','id','id','user_level_id');
    }
}
