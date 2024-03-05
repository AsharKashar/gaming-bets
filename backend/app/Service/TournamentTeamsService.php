<?php

namespace App\Service;


use App\Model\BombHistory;
use App\Model\Team;
use App\Model\TeamInvite;
use App\Model\TeamTournament;
use App\Model\TeamTournamentUser;
use App\Model\Tournament;
use App\Model\User;
use App\Model\UserNotification;
use Illuminate\Support\Collection;

class TournamentTeamsService
{

    public static function isMemberJoinedTournament(array $members, int $userId): bool
    {
        $isJoined = false;
        foreach ($members as $member) {
            if ($member['id'] === $userId) {
                $isJoined = true;
                break;
            }
        }
        return $isJoined;
    }


    public static function joinTeam(Team $team, Tournament $tournament, User $user){
        $teamTournament = TeamTournament::where('tournament_id',$tournament->id)
            ->where('team_id',$team->team_id)
            ->first();

        if (!$teamTournament) {
            $otherMembers = $team->members()->whereNotIn('user_id',[$user->id])->pluck('user_id')->toArray();
            foreach ($otherMembers as $userId) {
                NotificationsService::joinInvitation($tournament,$userId);
            }
        }

        $teamTournament = TeamTournament::updateOrCreate(
            [
                'tournament_id' => $tournament->id,
                'team_id' => $team->team_id
            ],[
            'tournament_id' => $tournament->id,
            'team_id' => $team->team_id,
        ]);

        TeamTournamentUser::updateOrCreate(
            [
                'team_tournament_id' => $teamTournament->id,
                'user_id' => $user->id,
            ], [
                'team_tournament_id' => $teamTournament->id,
                'user_id' =>  $user->id,
                'bomb_payed' => 1
            ]
        );

        $teamTournamentUserCount = TeamTournamentUser::where(['team_tournament_id' => $teamTournament->id, 'bomb_payed' => 1])->count();

        if ($tournament->team_size->size === $teamTournamentUserCount) {
            $teamTournament->update([
                'is_valid' => 1
            ]);
        }

    }

    public static function limitTeam(Team $team, $member = null) {
        return $team->sizes->size <= $member ?? ($team->member_size + TeamInvite::where(['team_id' => $team->team_id, 'status' => 0])->count());
    }


    public static function returnTeamTournamentByIds(array $teamTournamentIds, $notificationReason)
    {
        $teamTournament = TeamTournament::whereIn('id', $teamTournamentIds)->get();
        if ($teamTournament->first()) {
            $tournamentId = $teamTournament->first()->tournament_id;
            self::returnBombUserTeamTournament($teamTournament, $tournamentId, $notificationReason);
        }
    }

    public static function returnInvalidTeamTournament(int $tournamentId)
    {
        $teamTournament = TeamTournament::where(['tournament_id' => $tournamentId, 'is_valid' => 0])->get();
        self::returnBombUserTeamTournament($teamTournament, $tournamentId, UserNotification::$NOTIFICATION_REASON['team_kicked']);
    }

    public static function returnBombUserTeamTournament(Collection $teamTournament, int $tournamentId, $notificationReason=null) {
        $isPay = [];
        $tournament = Tournament::find($tournamentId);
        TeamTournamentUser::whereIn('team_tournament_id', $teamTournament->pluck('id')->toArray())
            ->where('bomb_payed', 1)->get()
            ->each(function ($teamTournamentUser) use ($tournamentId, &$isPay, $tournament, $notificationReason) {
                $type = BombHistory::TYPES['tournament'];

                if($refund = BombsPayment::returnUserBomb($teamTournamentUser->user_id, $type, [$type => $tournamentId])) {
                    $teamTournamentUser->update(['bomb_payed', 0]);
                    $isPay[] = 1;
                } else {
                    $isPay[] = 0;
                }

                    switch ($notificationReason){
                        case UserNotification::$NOTIFICATION_REASON['cancel_tournament']:
                        {
                            NotificationsService::tournamentWasCanceled($tournament, $teamTournamentUser->user_id, $refund);
                            break;
                        }
                        case UserNotification::$NOTIFICATION_REASON['bombs_refund']:
                        {
                            NotificationsService::bombsRefund($tournament, $teamTournamentUser->user_id, $refund);
                            break;
                        }
                        case UserNotification::$NOTIFICATION_REASON['team_kicked']:
                        {
                            NotificationsService::teamKickedUser($tournament, $teamTournamentUser->user_id, $refund);
                            break;
                        }
                        default:break;
                    }
            });
        if(!in_array(0, $isPay, true)) {
            $teamTournament->each(function ($teamTournament) {
                $teamTournament->delete();
            });
        }
    }


}
