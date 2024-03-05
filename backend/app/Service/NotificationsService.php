<?php


namespace App\Service;

use App\Events\UserEvent;
use App\Model\BombHistory;
use App\Model\BoxMatches;
use App\Model\Match;
use App\Model\Tournament;
use App\Model\User;
use App\Model\UserNotification;

class NotificationsService
{
    public static function winNotification(BombHistory $bombHistory, $userId=null, $reason=null) {
        $tournament = Tournament::find($bombHistory->pay['tournament_id']);
        $user = User::find($bombHistory->user_id);

        $data = [
            'tournament' => $tournament? $tournament->toArray() : [],
            'reward' => $bombHistory->bombs_reward,
            'totalBombs' => $user->total_bomb()
        ];

        $event = new UserEvent($reason ?? $bombHistory->type, $data, $userId ?? $bombHistory->user_id);
        broadcast($event);
    }

    public static function tournamentStatusChange($reason, $tournament, $userId) {
        $event = new UserEvent($reason, $tournament->toArray(), $userId);
        broadcast($event);
    }

    public static function joinTournamentNotification(Tournament $tournament, $userId) {

        $data = [
            'tournament' => $tournament? $tournament->toArray() : []
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['join_tournament'], $data, $userId);
        broadcast($event);
    }

    public static function tournamentWasCanceled(Tournament $tournament, $userId, $refund) {

        $data = [
            'tournament' => $tournament? $tournament->toArray() : []
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['cancel_tournament'], $data, $userId);
        broadcast($event);
        self::bombsRefund($tournament, $userId, $refund);
    }

    public static function bombsRefund(Tournament $tournament, $userId, $refund) {

        $data = [
            'tournament' => $tournament? $tournament->toArray() : [],
            'refund' => $refund? $refund->toArray() : []
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['bombs_refund'], $data, $userId, true);
        broadcast($event);
    }

    public static function joinInvitation(Tournament $tournament, $userId) {

        $data = [
            'tournament' => $tournament? $tournament->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['join_tournament_invitation'], $data, $userId);
        broadcast($event);
    }

    public static function tournamentWillStartSoon(Tournament $tournament, $userId=null) {

        $data = [
            'tournament' => $tournament? $tournament->toArray() : [],
        ];
        $players = $tournament->players();

        if ($userId) {
            $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['tournament_will_start_soon'], $data, $userId);
            broadcast($event);
            return;
        }
        foreach ($players as $player) {
            $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['tournament_will_start_soon'], $data, $player->id);
            broadcast($event);
        }
    }

    public static function teamKickedUser(Tournament $tournament, $userId, $refund=null) {
        $data = [
            'tournament' => $tournament? $tournament->toArray() : []
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['team_kicked'], $data, $userId);
        broadcast($event);

        $data['refund'] = $refund? $refund->toArray() : [];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['bombs_refund'], $data, $userId, true);
        broadcast($event);
    }

    public static function matchIsFinished($match, $userId) {

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['match_is_finished'], $data, $userId,true);
        broadcast($event);
    }

    public static function resultConflict($match, $userId) {

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['result_conflict'], $data, $userId,true);
        broadcast($event);
    }

    public static function matchWin($match, $userId) {

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['match_win'], $data, $userId);
        broadcast($event);
    }

    public static function createMatch($match, $userId) {

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['create_match'], $data, $userId, true);
        broadcast($event);
    }

    public static function hostIsCreatingMatch($host, $userId) {

        $data = [
            'host' => $host? $host->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['host_creating_match'], $data, $userId, true);
        broadcast($event);
    }

    public static function joinMatch($match, $userId) {

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['join_match'], $data, $userId, true);
        broadcast($event);
    }

    public static function matchLoose($match, $userId) {

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['match_loose'], $data, $userId);
        broadcast($event);
    }

    public static function matchWillStartSoon(Match $match, $userId=null) {

        $data = [
            'match' => $match? $match->toArray() : [],
        ];
        $players = $match->players;

        if ($userId) {
            $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['match_will_start_soon'], $data, $userId);
            broadcast($event);
            return;
        }
        foreach ($players as $player) {
            $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['match_will_start_soon'], $data, $player->id);
            broadcast($event);
        }
    }

    public static function challengePreStart($match, $userId) {// on hold

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_pre_start'], $data, $userId);
        if (!app()->isLocal()) {
            broadcast($event);
        }
    }


    public static function challengeJoinSameTeam($match, $userId, $newUserId) {//done

        $data = [
            'match' => $match? $match->toArray() : [],
            'new_user' => User::find($newUserId),
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_join_same_team'], $data, $userId);
        if (!app()->isLocal()) {
               broadcast($event);
        }
    }

    public static function challengeJoinOpponentTeam($match, $userId, $newUserId) {//done

        $data = [
            'match' => $match? $match->toArray() : [],
            'new_user' => User::find($newUserId),
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_join_opponent_team'], $data, $userId);
        if (!app()->isLocal()) {
            broadcast($event);
        }
    }

    public static function challengeCancelled($match, $userId, $reason, $refund) {//done

        $data = [
            'match' => $match? $match->toArray() : [],
            'reason' => BoxMatches::$REASON_CANCELLATION[$reason],
            'refund_amount' => $refund,
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_cancelled'], $data, $userId);
        if (!app()->isLocal()) {
            broadcast($event);
        }
    }

    public static function challengeStart($match, $userId) {//done

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_started'], $data, $userId);
        broadcast($event);
    }


    public static function challengeTimeEnded($match, $userId) {//done

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_time_ended'], $data, $userId);
        if (!app()->isLocal()) {
            broadcast($event);
        }
    }

    public static function challengeFinished($match, $userId, $result) {//done

        $data = [
            'match' => $match? $match->toArray() : [],
            'result' => $result,
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_finished'], $data, $userId);
        if (!app()->isLocal()) {
            broadcast($event);
        }
    }

    public static function challengeConflict($match, $userId) {//done

        $data = [
            'match' => $match? $match->toArray() : [],
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_conflict'], $data, $userId);
        if (!app()->isLocal()) {
            broadcast($event);
        }
    }

    public static function challengeDelete($match, $userId, $refund) {//done

        $data = [
            'match' => $match? $match->toArray() : [],
            'refund_amount' => $refund,
        ];

        $event = new UserEvent(UserNotification::$NOTIFICATION_REASON['challenge_delete'], $data, $userId);
        if (!app()->isLocal()) {
            broadcast($event);
        }
    }
}
