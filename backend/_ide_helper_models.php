<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Team
 *
 * @property int $team_id
 * @property string $name
 * @property int $size
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $checked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $members
 * @property-read int|null $members_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereChecked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereUpdatedAt($value)
 */
	class Team extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\MatchResult
 *
 * @property int $result_id
 * @property int $tournament_id
 * @property int $match_id
 * @property int $player_id
 * @property string $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $player
 * @property-read \App\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult whereResultId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchResult whereUpdatedAt($value)
 */
	class MatchResult extends \Eloquent {}
}

namespace App{
/**
 * App\Game
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $cover
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GameRules[] $rules
 * @property-read int|null $rules_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereUpdatedAt($value)
 */
	class Game extends \Eloquent {}
}

namespace App\Relations{
/**
 * App\Relations\MatchTeamRelation
 *
 * @property int $id
 * @property int $match_id
 * @property int $team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $e_image
 * @property string|null $e_video
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation whereEImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation whereEVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\MatchTeamRelation whereUpdatedAt($value)
 */
	class MatchTeamRelation extends \Eloquent {}
}

namespace App\Relations{
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
 */
	class TeamTournamentRelation extends \Eloquent {}
}

namespace App\Relations{
/**
 * App\Relations\TeamUserRelation
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string $activision
 * @property int $checked_in
 * @property int $is_leader
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereActivision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereCheckedIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereIsLeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Relations\TeamUserRelation whereUserId($value)
 */
	class TeamUserRelation extends \Eloquent {}
}

namespace App{
/**
 * App\Post
 *
 * @property int $post_id
 * @property int $category_id
 * @property string $title
 * @property string $image
 * @property string $body
 * @property int $featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedAt($value)
 */
	class Post extends \Eloquent {}
}

namespace App{
/**
 * App\TournamentRules
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $tournament_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentRules whereUpdatedAt($value)
 */
	class TournamentRules extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserAwards[] $awards
 * @property-read int|null $awards_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PaymentHistory[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tournament[] $tournaments
 * @property-read int|null $tournaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAdminType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBoxfightsAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBoxfightsRenew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSubscribeQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserType($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\UserAwards
 *
 * @property int $id
 * @property int $user_id
 * @property float $allowed_tournaments
 * @property float $limas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $box_game_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards whereAllowedTournaments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards whereBoxGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards whereLimas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAwards whereUserId($value)
 */
	class UserAwards extends \Eloquent {}
}

namespace App{
/**
 * App\UserCard
 *
 * @property int $id
 * @property string $number
 * @property string $exp_month
 * @property string $exp_year
 * @property int $user_id
 * @property string $cvc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereCvc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereExpMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereExpYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereUserId($value)
 */
	class UserCard extends \Eloquent {}
}

namespace App{
/**
 * App\GameRules
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GameRules whereUpdatedAt($value)
 */
	class GameRules extends \Eloquent {}
}

namespace App{
/**
 * App\ReportIsuue
 *
 * @property int $id
 * @property string $title
 * @property string $email
 * @property string $description
 * @property int $user_id
 * @property string $status
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReportIsuue whereUserId($value)
 */
	class ReportIsuue extends \Eloquent {}
}

namespace App{
/**
 * App\UserPoint
 *
 * @property int $id
 * @property float $points
 * @property float $winning
 * @property int $user_id
 * @property int $tournament_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Game $game
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserPoint whereWinning($value)
 */
	class UserPoint extends \Eloquent {}
}

namespace App{
/**
 * App\Membership
 *
 * @property int $id
 * @property string $stripe_id
 * @property string $user_id
 * @property string|null $sub_id
 * @property string|null $plan_id
 * @property string|null $boxfight_quantity
 * @property string|null $daily_allowed
 * @property string|null $weekly_allowed
 * @property string|null $monthly_allowed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $daily_quantity
 * @property string|null $weekly_quantity
 * @property string|null $monthly_quantity
 * @property string|null $membership_quantity
 * @property string|null $permission
 * @property string|null $daily_date
 * @property string|null $weekly_date
 * @property string|null $monthly_date
 * @property string|null $sub_update_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereBoxfightQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereDailyAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereDailyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereDailyQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereMembershipQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereMonthlyAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereMonthlyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereMonthlyQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership wherePermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereSubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereSubUpdateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereWeeklyAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereWeeklyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Membership whereWeeklyQuantity($value)
 */
	class Membership extends \Eloquent {}
}

namespace App{
/**
 * App\box_matches
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BoxMatches newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BoxMatches newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BoxMatches query()
 */
	class box_matches extends \Eloquent {}
}

namespace App{
/**
 * App\Currency
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App{
/**
 * App\TournamentPrize
 *
 * @property int $id
 * @property int|null $team_id
 * @property int $tournament_id
 * @property string $position
 * @property float $prize
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $point
 * @property-read \App\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize wherePrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentPrize whereUpdatedAt($value)
 */
	class TournamentPrize extends \Eloquent {}
}

namespace App{
/**
 * App\Match
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $players
 * @property-read int|null $players_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MatchResult[] $results
 * @property-read int|null $results_count
 * @property-read \App\Team|null $teamA
 * @property-read \App\Team|null $teamB
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \App\Team|null $winnerTeam
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereCloseFor1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereCloseFor2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereEImage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereEImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereEVideo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereEVideo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereHostedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereIsFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereParent1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereParent2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereTeam1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereTeam2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereWinnerId($value)
 */
	class Match extends \Eloquent {}
}

namespace App{
/**
 * App\MatchMaps
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchMaps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchMaps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchMaps query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchMaps whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchMaps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MatchMaps whereUpdatedAt($value)
 */
	class MatchMaps extends \Eloquent {}
}

namespace App{
/**
 * App\Tournament
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
 * @property string|null $platforms
 * @property string|null $hosted_by
 * @property string $status
 * @property string|null $game_type
 * @property string|null $game_mode
 * @property string|null $match_type
 * @property string|null $match_set
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $check_teams
 * @property-read int|null $check_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $disqualified_teams
 * @property-read int|null $disqualified_teams_count
 * @property-read \App\Game $game
 * @property-read mixed $allow_team_members
 * @property-read mixed $has_multiple_members
 * @property-read mixed $match_rounds
 * @property-read mixed $team_v_s
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Match[] $matches
 * @property-read int|null $matches_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $players
 * @property-read int|null $players_count
 * @property-read \App\TournamentResult|null $results
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TournamentRules[] $rules
 * @property-read int|null $rules_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TournamentPrize[] $teamResults
 * @property-read int|null $team_results_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @property-read int|null $teams_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereBracketSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereBracketType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereCheckIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereEntryFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereFirstPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereFirstPrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereGameMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereGameType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereHostedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereKickoffIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereMatchSet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereMatchType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament wherePerMatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament wherePlatforms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereRegEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereRegStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereRegions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereRepeat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereRoundsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereSecondPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereSecondPrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereTeamSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereThirdPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereThirdPrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereTopPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tournament whereUpdatedAt($value)
 */
	class Tournament extends \Eloquent {}
}

namespace App{
/**
 * App\PaymentHistory
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $tournament_id
 * @property float|null $limas
 * @property float $pay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $withdrawal
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory whereLimas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory wherePay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PaymentHistory whereWithdrawal($value)
 */
	class PaymentHistory extends \Eloquent {}
}

namespace App{
/**
 * App\TournamentResult
 *
 * @property int $id
 * @property int $tournament_id
 * @property int $first_place
 * @property int $second_place
 * @property int $third_place
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $first
 * @property-read \App\User $second
 * @property-read \App\User $third
 * @property-read \App\Tournament $tournament
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult whereFirstPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult whereSecondPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult whereThirdPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TournamentResult whereUpdatedAt($value)
 */
	class TournamentResult extends \Eloquent {}
}

namespace App{
/**
 * App\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BaseModel query()
 */
	class BaseModel extends \Eloquent {}
}

