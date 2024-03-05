<?php

namespace App\Model;

use App\Service\BombsPayment;
use App\Service\NotificationsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\BoxMatches
 *
 * @property int $id
 * @property string|null $match_id
 * @property string $team_id
 * @property string $bid_amount
 * @property string $game_type
 * @property string $platform
 * @property string $region
 * @property string|null $user_id
 * @property string|null $username
 * @property string|null $result
 * @property string|null $proof
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $conflict_flag
 * @property string|null $game_id
 * @property string|null $time
 * @property string|null $proof_secondary
 * @property string|null $matchEnd_time
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatches onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereBidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereConflictFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereGameType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereMatchEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereProofSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatches withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BoxMatches withoutTrashed()
 * @mixin \Eloquent
 * @property int $game_type_boxmatch_id
 * @property int $platform_id
 * @property int $region_id
 * @property string $boxmatch_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BoxmatchUser[] $boxMatchUsers
 * @property-read int|null $boxmatch_users_count
 * @property-read \App\Model\Game|null $game
 * @property-read \App\Model\GameTypeBoxmatch $gameTypeBoxmatch
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BoxMatchResult[] $results
 * @property-read int|null $results_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereBoxmatchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereGameTypeBoxmatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches wherePlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BoxMatches whereRegionId($value)
 * @property-read int|null $box_match_users_count
 */
class BoxMatches extends Model
{
    use SoftDeletes;

    //

    protected $dates = ['deleted_at'];
    protected $hidden = [
        'created_at',
        'updated_at',
        'platform_id',
        'region_id',
        // 'game_type_boxmatch_id',
        // 'game_id',
        'deleted_at'
    ];


    public const TEAMS_ALLOWED = 2;

    public const ONE_VS_ONE = 1;
    public const TWO_VS_TWO = 1;

    public const MATCH_JOINING_IN_PROGRESS = 1;
    public const MATCH_IS_FULL = 2;
    public const MATCH_IS_LIVE = 3;
    public const MATCH_HAS_ENDED = 4;
    public const MATCH_IS_FINISHED = 5;
    public const MATCH_CANCELLED = 6;

    public const EVIDENCE_CONFLICT = 1;
    public const EVIDENCE_UPLOAD_IS_OVER = 2;

    public const WINNER_TEAM1 = 1;
    public const WINNER_TEAM2 = 2;
    public const WINNER_CANCELLED = 0;

    public const MATCH_WON = 'won';
    public const MATCH_LOST = 'lost';

    public static $REASON_CANCELLATION = [
        'not_enough_user' => 'not_enough_user',
        'lack_of_evidence' => 'lack_of_evidence',
        'no_results_uploaded' => 'no_results_uploaded',
    ];

    public function results()
    {
        return $this->hasMany(BoxMatchResult::class, 'boxmatch_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function platform()
    {
        return $this->belongsTo(GamePlatform::class, 'platform_id');
    }

    public function gameTypeBoxmatch()
    {
        return $this->belongsTo(GameTypeBoxmatch::class, 'game_type_boxmatch_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function boxMatchUsers()
    {
        return $this->hasMany(BoxmatchUser::class, 'match_id');
    }

    public static function systemCancellation()
    {
        $collection = self::where('status', self::MATCH_JOINING_IN_PROGRESS)
            ->get();
        foreach ($collection as $item) {
            $minutesFromStarting = Carbon::parse($item->time)->diffInMinutes(now(), false);
            if ($minutesFromStarting >= 0) {
                $item->status = self::MATCH_CANCELLED;
                $item->save();
                self::cancelNotification($item, $item->bid_amount, BoxMatches::$REASON_CANCELLATION['not_enough_user']);
                $matchMembers = BoxmatchUser::where('match_id', $item->id)->get();
                foreach ($matchMembers as $member) {
                    BombsPayment::RefundUser(
                        $member->user_id,
                        BombHistory::TYPES['boxMatch'],
                        $member->match_id
                    );
                    // $refund = new User1Awards();
                    // $refund->user_id = $member->user_id;
                    // $refund->bomb = $member->bid_amount;
                    // $refund->save();
                }
            }
        }
    }

    public static function ifMatchHaveResult($id)
    {
        $boxMatches = BoxmatchUser::where('match_id', $id)->get();
        foreach ($boxMatches as $boxMatch) {
            if (is_null($boxMatch->result)) {
                return true;
            }
        }

        return false;
    }

    public static function teamMemberWon($member, $award, $match)
    {
        $member->result = self::MATCH_WON;
        $match->conflict_flag = null;
        $match->status = self::MATCH_IS_FINISHED;
        $match->save();
        BoxMatchResult::addwinner($member->match_id, $member->user_id, $award);
        BombsPayment::AwardUser(
            $member->user_id,
            BombHistory::TYPES['boxMatch'],
            0,
            $award,
            0,
            $member->match_id
        );
    }

    public static function teamMemberLost($member, $match)
    {
        $member->result = self::MATCH_LOST;
        $match->status = self::MATCH_IS_FINISHED;
        $match->conflict_flag = null;
        $member->save();
        $match->save();
    }

    public static function matchCancelledRefundAwards($member, $award, $match)
    {
        $match->conflict_flag = null;
        $match->status = self::MATCH_CANCELLED;
        $match->save();
        BoxMatches::cancelNotification($match, $match->bid_amount, BoxMatches::$REASON_CANCELLATION['lack_of_evidence']);
        BombsPayment::RefundUser(
            $member->user_id,
            BombHistory::TYPES['boxMatch'],
            $member->match_id
        );
    }




    public static function addAwardsToTeamByMatchDetails($team, $bidAmount)
    {
        foreach ($team as $member) {
            $member->result = self::MATCH_WON;
            BoxMatchResult::addwinner($member->match_id, $member->user_id, $bidAmount);
            BombsPayment::AwardUser(
                $member->user_id,
                BombHistory::TYPES['boxMatch'],
                0,
                $bidAmount,
                0,
                $member->match_id
            );
            $member->save();
        }
    }


    public static function decision()
    {
        $data = self::where('status', self::MATCH_HAS_ENDED)->where('conflict_flag', null)->get();
        foreach ($data as $dat) {
            $minutesFromStartingTime = Carbon::parse($dat->matchEnd_time)->diffInMinutes(now(), false);
            if ($minutesFromStartingTime >= 10) {
                $matchList = BoxmatchUser::where('match_id', $dat->id)->get();
                $null_flag = 0;
                foreach ($matchList as $nullCheck) {
                    if ($nullCheck->result) {
                        $null_flag = 1;
                    }
                }
                if ($null_flag == 0) {
                    $dat->status = self::MATCH_CANCELLED;
                    $dat->save();
                    self::cancelNotification($dat, $dat->bid_amount, BoxMatches::$REASON_CANCELLATION['no_results_uploaded']);
                    foreach ($matchList as $cancelMatch) {
                        BombsPayment::RefundUser(
                            $cancelMatch->user_id,
                            BombHistory::TYPES['boxMatch'],
                            $cancelMatch->match_id
                        );
                       }
                    return;
                }
                if ($minutesFromStartingTime >= 10) {
                    $team1 = BoxmatchUser::where('match_id', $dat->id)
                        ->where('team_id', self::WINNER_TEAM1)
                        ->where('result', self::MATCH_WON)
                        ->get();
                    $team2 = BoxmatchUser::where('match_id', $dat->id)
                        ->where('team_id', self::WINNER_TEAM2)
                        ->where('result', self::MATCH_WON)
                        ->get();

                    if (count($team1) < count($team2)) {
                        self::winningAward($team2, $team1, $dat);
                        self::finishNotification($dat);
                    }

                    if (count($team1) > count($team2)) {
                        self::winningAward($team1, $team2, $dat);
                        self::finishNotification($dat);
                    }

                    if (count($team1) == count($team2)) {
                        $dat->conflict_flag = self::EVIDENCE_CONFLICT;
                        $dat->save();
                        self::conflictNotification($dat);
                    }
                }
            }
        }
    }


    public static function goLive()
    {
        $AllData = self::where('status', self::MATCH_IS_FULL)
            ->get();
        foreach ($AllData as $data) {
            $minutesFromStarting = Carbon::parse($data->time)->diffInMinutes(now(), false);
            if ($minutesFromStarting >= 0) {
                $data->status = self::MATCH_IS_LIVE;
                $data->save();
                self::startNotification($data);
            }
        }
    }

    public static function endMatch()
    {
        $AllData = self::where('status', self::MATCH_IS_LIVE)
            ->get();
        foreach ($AllData as $data) {
            $minutesFromStarting = Carbon::parse($data->time)->diffInMinutes(now(), false);
            if ($minutesFromStarting >= 25) {
                $data->status = self::MATCH_HAS_ENDED;
                $data->matchEnd_time = Carbon::now();
                $data->save();
                self::endNotification($data);
            }
        }
    }

    public static function endUploadTime()
    {
        $AllData = self::where('status', self::MATCH_HAS_ENDED)
            ->where('conflict_flag', self::EVIDENCE_CONFLICT)
            ->get();
        foreach ($AllData as $data) {
            $minutesFromEnding = Carbon::parse($data->matchEnd_time)->diffInMinutes(now(), false);
            if ($minutesFromEnding >= 20) {
                $matchMembers = BoxmatchUser::where('match_id', $data->id)->get();
                if (self::matchHasProof($matchMembers)) {
                    self::createAwardsAfterCancellation($matchMembers, $data);
                } else {
                    self::matchEvidenceIsOver($data);
                }
            }
        }
    }

    public static function matchEvidenceIsOver($matchMembers)
    {
        $matchMembers->conflict_flag = self::EVIDENCE_UPLOAD_IS_OVER;
        $matchMembers->save();
    }

    public static function matchHasProof($matchMembers)
    {
        foreach ($matchMembers as $nullCheck) {
            if ($nullCheck->proof_image || $nullCheck->proof_video) {
                return false;
            }
        }

        return true;
    }

    public static function createAwardsAfterCancellation($matchMembers, $mainMatch)
    {
        $mainMatch->status = self::MATCH_CANCELLED;
        $mainMatch->conflict_flag = null;
        $mainMatch->save();
        self::cancelNotification($mainMatch, $mainMatch->bid_amount, BoxMatches::$REASON_CANCELLATION['lack_of_evidence']);
        foreach ($matchMembers as $member) {
            BombsPayment::RefundUser(
                $member->user_id,
                BombHistory::TYPES['boxMatch'],
                $member->match_id
            );
          }
    }

    public static function deleteMatch($id)//DELETENOTIFICATION
    {
        $data = self::find($id);
        $Allmatches = BoxmatchUser::where('match_id', $id)->get();
        if ($data->status == self::MATCH_IS_FINISHED || $data->status == self::MATCH_CANCELLED) {
            $data->delete();
            foreach ($Allmatches as $match) {
                $match->delete();
            }
            return;
        }
        foreach ($Allmatches as $match) {
            self::deleteNotification($match, $match->bid_amount);
            BombsPayment::RefundUser(
                $match->user_id,
                BombHistory::TYPES['boxMatch'],
                $match->match_id
            );
            $match->delete();
        }
        $data->delete();
    }

    public static function notLoggedIn($game_id, $per_page)
    {
        $data = self::where('game_id', $game_id)
            ->where(
                function ($query) {
                    $query->where('status', self::MATCH_JOINING_IN_PROGRESS)
                        ->orWhere('status', self::MATCH_IS_FULL);
                }
            )
            ->orderBy('time', 'asc')->with('region')->with('platform')->with('gameTypeBoxmatch')->with('game')->paginate($per_page);
        foreach ($data as $key => $out) {
            $data[$key]['remarks'] = "User not logged In";
        }
        return $data;
    }

    public static function viewBoxfightsHistory($user_id, $game_id)
    {
        $output = [];
        $finshedjMatches = [];
        $finishIndex = 0;
        $participations = BoxmatchUser::where('user_id', $user_id)->get();
        foreach ($participations as $participant) {
            $boxmatch = self::where('id', $participant->match_id)->with('region')->with('platform')->with(
                'gameTypeBoxmatch'
            )->with('game')->first();
            if ($boxmatch->status == self::MATCH_IS_FINISHED && $boxmatch->game_id == $game_id) {
                $finshedjMatches[$finishIndex] = $boxmatch;
                $finishIndex = $finishIndex + 1;
            }
        }

        foreach ($finshedjMatches as $key => $finish) {
            $boxMatchUser = BoxmatchUser::where('match_id', $finish->id)->where('is_host', '1')->first();
            $finshedjMatches[$key]['user'] = User::find($boxMatchUser->user_id);
        }
        $output['Finished Matches'] = self::addUserStatus($finshedjMatches, $user_id);

        $cancellations = [];
        $indexkey = 0;
        $participations = BoxmatchUser::where('user_id', $user_id)->get();
        foreach ($participations as $participant) {
            $boxmatch = self::where('id', $participant->match_id)->with('region')->with('platform')->with(
                'gameTypeBoxmatch'
            )->with('game')->first();
            if ($boxmatch->status == self::MATCH_CANCELLED) {
                $cancellations[$indexkey] = $boxmatch;
                $indexkey = $indexkey + 1;
            }
        }
        foreach ($cancellations as $key => $cancelled) {
            $boxMatchUser = BoxmatchUser::where('match_id', $cancelled->id)->where('is_host', '1')->first();
            $cancellations[$key]['user'] = User::find($boxMatchUser->user_id);
        }
        $output['Cancelled Matches'] = $cancellations;

        return $output;
    }

    public static function viewBoxfights($user_id, $game_id, $per_page)
    {
        $output = [];
        $output['Active Matches'] = self::where('game_id', $game_id)
            ->where(
                function ($query) {
                    $query->where('status', self::MATCH_JOINING_IN_PROGRESS)
                        ->orWhere('status', self::MATCH_IS_FULL);
                }
            )
            ->orderBy('time', 'asc')->with('region')->with('platform')->with('gameTypeBoxmatch')->with('game')->paginate($per_page);
        foreach ($output['Active Matches'] as $key => $active) {
            $boxMatchUser = BoxmatchUser::where('match_id', $active->id)->where('is_host', '1')->first();
            $output['Active Matches'][$key]['user'] = User::find($boxMatchUser->user_id);
        }


        $output['Active Matches'] = self::checkIfJoinedOrFull($output['Active Matches'], $user_id);

        $liveMatches = [];
        $liveIndex = 0;
        $participations = BoxmatchUser::where('user_id', $user_id)->get();
        foreach ($participations as $participant) {
            $boxmatch = self::where('id', $participant->match_id)->with('region')->with('platform')->with(
                'gameTypeBoxmatch'
            )->with('game')->first();
            if (($boxmatch->status == self::MATCH_IS_LIVE || $boxmatch->status == self::MATCH_HAS_ENDED) && $boxmatch->game_id == $game_id) {
                $liveMatches[$liveIndex] = $boxmatch;
                $liveIndex = $liveIndex + 1;
            }
        }

        foreach ($liveMatches as $key => $live) {
            $boxMatchUser = BoxmatchUser::where('match_id', $live->id)->where('is_host', '1')->first();
            $liveMatches[$key]['user'] = User::find($boxMatchUser->user_id);
        }

        $alldata1 = $liveMatches;

        $alldata2 = self::addUserStatus($alldata1, $user_id);
        $output['Live Matches'] = $alldata2;

        return $output;
    }


    public static function checkIfJoinedOrFull($recievedData, $user_id)
    {
        foreach ($recievedData as $key_id => $match) {
            $child_matches = BoxmatchUser::where('match_id', $match->id)->get();
            $tem = 0;
            foreach ($child_matches as $key_child => $child) {
                if ($child->user_id == $user_id) {
                    $recievedData[$key_id]['remarks'] = 'joined';
                    $tem = 1;
                }
            }
            if ($tem == 0) {
                $recievedData[$key_id]['remarks'] = 'Open for joining';
            }
        }

        foreach ($recievedData as $key_id => $match) {
            if ($match->remarks != 'joined' && $match->status == self::MATCH_IS_FULL) {
                $recievedData[$key_id]['remarks'] = 'full';
            }
        }
        return $recievedData;
    }


    public static function addUserStatus($alldata1, $user_id)
    {
        $returnData = [];
        $index = 0;
        $alldata2 = [];
        foreach ($alldata1 as $all1) {
            $alldata2 = self::where('id', $all1->id)->with('region')->with('platform')->with('gameTypeBoxmatch')->with(
                'game'
            )->first();
            $hostUser = BoxmatchUser::where('match_id', $all1->id)->where('is_host', 1)->first();
            $userBox = BoxmatchUser::where('match_id', $all1->id)->where('user_id', $user_id)->first();
            $alldata2['user'] = User::find($hostUser->user_id);

            if ($userBox->result && $alldata2->status == self::MATCH_HAS_ENDED && !$alldata2->conflict_flag) {
                $alldata2['remarks'] = 'result entered';
            } else {
                if (!$userBox->result && $alldata2->status == self::MATCH_HAS_ENDED && !$alldata2->conflict_flag) {
                    $alldata2['remarks'] = 'match ended result required';
                } else {
                    if (!$userBox->result && $alldata2->status == self::MATCH_IS_LIVE) {
                        $alldata2['remarks'] = 'match is live';
                    } else {
                        if (
                            $userBox->result && $alldata2->status == self::MATCH_HAS_ENDED && ($alldata2->conflict_flag == self::EVIDENCE_CONFLICT || $alldata2->conflict_flag == self::EVIDENCE_UPLOAD_IS_OVER) &&
                            (
                                $userBox->proof_image || $userBox->proof_video
                            )) {
                            $alldata2['remarks'] = 'evidence uploaded';
                        } else {
                            if ($userBox->result && $alldata2->status == self::MATCH_HAS_ENDED && $alldata2->conflict_flag == self::EVIDENCE_CONFLICT &&
                                (
                                    !$userBox->proof_image && !$userBox->proof_video
                                )) {
                                $alldata2['remarks'] = 'conflict! evidence required';
                            } else {
                                if ($userBox->result && $alldata2->status == self::MATCH_HAS_ENDED && $alldata2->conflict_flag == self::EVIDENCE_UPLOAD_IS_OVER &&
                                    (
                                        !$userBox->proof_image && !$userBox->proof_video
                                    )) {
                                    $alldata2['remarks'] = 'conflict! evidence upload time is over';
                                } else {
                                    if ($alldata2->status == self::MATCH_IS_FINISHED && $userBox->result == self::MATCH_WON) {
                                        $alldata2['remarks'] = self::MATCH_WON;
                                    } else {
                                        if ($alldata2->status == self::MATCH_IS_FINISHED && $userBox->result == self::MATCH_LOST) {
                                            $alldata2['remarks'] = self::MATCH_LOST;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $returnData[$index] = $alldata2;
            $index = $index + 1;
        }
        return $returnData;
    }


    public static function checkFreeFights($user_id)
    {
        $user_data = User::find($user_id);
        if ($user_data->boxfights_allowed == 0) {
            $membership = Membership::where('user_id', $user_id)->first();
            if ($membership) {
                if ($membership->boxfight_quantity > 0) {
                    $membership->boxfight_quantity = $membership->boxfight_quantity - 1;
                    $membership->save();
                    return true;
                }
                return false;
            }
            return false;
        }

        $user_data->boxfights_allowed = $user_data->boxfights_allowed - 1;
        $user_data->save();
        return true;
    }


    public static function extractResult($id)
    {
        $team1 = BoxmatchUser::where('match_id', $id)->where('team_id', self::WINNER_TEAM1)->where(
            'result',
            self::MATCH_WON
        )->get();
        $team2 = BoxmatchUser::where('match_id', $id)->where('team_id', self::WINNER_TEAM2)->where(
            'result',
            self::MATCH_WON
        )->get();
        $match_details = self::find($id);

        if (count($team1) < count($team2)) {
            self::winningAward($team2, $team1, $match_details);
            self::finishNotification($match_details);
        } else {
            if (count($team1) > count($team2)) {
                self::winningAward($team1, $team2, $match_details);
                self::finishNotification($match_details);
            } else {
                if (count($team1) == count($team2)) {
                    $match_details->conflict_flag = self::EVIDENCE_CONFLICT;
                    $match_details->save();
                    self::conflictNotification($match_details);
                }
            }
        }
    }


    public static function winningAward($winner, $losers, $match_details)
    {
        $save_amount = $match_details->bid_amount * 2;

        self::addAwardsToTeamByMatchDetails($winner, $save_amount);


        foreach ($losers as $loser) {
            $loser->result = self::MATCH_LOST;
            $loser->save();
        }
        $match_details->status = self::MATCH_IS_FINISHED;
        $match_details->save();
    }

    public static function checkIfUserAlreadyJoined($match_id, $user_id)
    {
        $matches = BoxmatchUser::where('match_id', $match_id)->where('user_id', $user_id)->first();
        if ($matches) {
            return true;
        }
        return false;
    }

    public static function setRemarks($parentMatch, $childMatches)
    {
        if ($parentMatch->status == self::MATCH_IS_FULL || $parentMatch->status == self::MATCH_JOINING_IN_PROGRESS) {
            $parentMatch['remarks'] = 'joined';
        } else {
            if ($childMatches->result && $parentMatch->status == self::MATCH_HAS_ENDED && !$parentMatch->conflict_flag) {
                $parentMatch['remarks'] = 'result entered';
            } else {
                if (!$childMatches->result && $parentMatch->status == self::MATCH_HAS_ENDED && !$parentMatch->conflict_flag) {
                    $parentMatch['remarks'] = 'match ended result required';
                } else {
                    if (!$childMatches->result && $parentMatch->status == self::MATCH_IS_LIVE) {
                        $parentMatch['remarks'] = 'match is live';
                    } else {
                        if (
                            $childMatches->result && $parentMatch->status == self::MATCH_HAS_ENDED && ($parentMatch->conflict_flag == self::EVIDENCE_CONFLICT || $parentMatch->conflict_flag == self::EVIDENCE_UPLOAD_IS_OVER) &&
                            (
                                $childMatches->proof_image || $childMatches->proof_video
                            )) {
                            $parentMatch['remarks'] = 'evidence uploaded';
                        } else {
                            if ($childMatches->result && $parentMatch->status == self::MATCH_HAS_ENDED && $parentMatch->conflict_flag == self::EVIDENCE_CONFLICT &&
                                (
                                    !$childMatches->proof_image && !$childMatches->proof_video
                                )) {
                                $parentMatch['remarks'] = 'conflict! evidence required';
                            } else {
                                if ($childMatches->result && $parentMatch->status == self::MATCH_HAS_ENDED && $parentMatch->conflict_flag == self::EVIDENCE_UPLOAD_IS_OVER &&
                                    (
                                        !$childMatches->proof_image && !$childMatches->proof_video
                                    )) {
                                    $parentMatch['remarks'] = 'conflict! evidence upload time is over';
                                } else {
                                    if ($parentMatch->status == self::MATCH_IS_FINISHED && $childMatches->result == self::MATCH_WON) {
                                        $parentMatch['remarks'] = self::MATCH_WON;
                                    } else {
                                        if ($parentMatch->status == self::MATCH_IS_FINISHED && $childMatches->result == self::MATCH_LOST) {
                                            $parentMatch['remarks'] = self::MATCH_LOST;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        return $parentMatch;
    }





    public static function joinNotification($assigned_team, $match_details, $user_id)
    {
        $participants = BoxmatchUser::where('match_id', $match_details->id)->get();
        foreach($participants as $participant){
            if($participant->team_id == $assigned_team && $participant->user_id != $user_id){
                NotificationsService::challengeJoinSameTeam($match_details, $user_id, $participant->user_id);
            }
            else if($participant->team_id != $assigned_team && $participant->user_id != $user_id){
                NotificationsService::challengeJoinOpponentTeam($match_details, $participant->user_id, $user_id);
            }
        }
    }

    public static function startNotification($match_details)
    {
        $participants = BoxmatchUser::where('match_id',$match_details->id)->get();
        foreach($participants as $participant){
            NotificationsService::challengeStart($match_details, $participant->user_id);
        }
    }

    public static function endNotification($match_details)
    {
        $participants = BoxmatchUser::where('match_id',$match_details->id)->get();
        foreach($participants as $participant){
            NotificationsService::challengeTimeEnded($match_details, $participant->user_id);
        }
    }

    public static function finishNotification($match_details)
    {
        $participants = BoxmatchUser::where('match_id',$match_details->id)->get();
        foreach($participants as $participant){
            NotificationsService::challengeFinished($match_details, $participant->user_id, $participant->result);
        }
    }

    public static function conflictNotification($match_details)
    {
        $participants = BoxmatchUser::where('match_id',$match_details->id)->get();
        foreach($participants as $participant){
            NotificationsService::challengeConflict($match_details, $participant->user_id);
        }
    }

    public static function cancelNotification($match_details, $refund, $reason)
    {
        $participants = BoxmatchUser::where('match_id',$match_details->id)->get();
        foreach($participants as $participant){
            NotificationsService::challengeCancelled($match_details, $participant->user_id, BoxMatches::$REASON_CANCELLATION[$reason], $refund);
        }
    }

    public static function deleteNotification($match_details, $refund)
    {
        $participants = BoxmatchUser::where('match_id',$match_details->id)->get();
        foreach($participants as $participant){
            NotificationsService::challengeDelete($match_details, $participant->user_id, $refund);
        }
    }
}
