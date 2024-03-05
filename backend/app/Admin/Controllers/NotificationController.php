<?php

namespace App\Admin\Controllers;

use App\Model\BombHistory;
use App\Model\Match;
use App\Model\Tournament;
use App\Model\User;
use App\Model\UserNotification;
use App\Service\NotificationsService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;

class NotificationController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->header('Trigger Notification')
            ->description('FOR DEVELOPMENT ONLY')
            ->body($this->form());
    }

    protected function form()
    {
        $form = new Form(new UserNotification());
        $form->number('user_id','User id')->required()->min(1);
        $form->select('notification_type','Notification type')->options([
            'win_tournament_notification' => 'Win notification',
            'start_tournament_notification' => 'Tournament start notification',
            'tournament_joined' => 'Tournament joined',
            'tournament_canceled' => 'Tournament canceled',
            'bombs_refund' => 'Bombs refund',
            'join_tournament_invitation' => 'Invitation to join tournament',
            'tournament_will_start_soon' => 'Tournament will start soon',
            'team_kicked' => 'Team was kicked',
            'match_is_finished' => 'Match is finished?',
            'result_conflict' => 'Result conflict',
            'match_win' => 'Match win',
            'match_will_start_soon' => 'Match will start soon',
            'create_match' => 'Create match and invite users',
            'host_creating_match' => 'Host is creating a match ',
            'match_loose' => 'Match loose'
        ])->required();
        $form->setAction('user-notifications');
        $form->ignore(['notification_type','user_id']);

        $form->submitted(function () {
            $userId = request()->input('user_id');
            $notificationType = request()->input('notification_type');

            switch ($notificationType) {
                case  'win_tournament_notification':
                    $bombHistory = BombHistory::where('type', BombHistory::TYPES['tournament'])->first();
                    NotificationsService::winNotification($bombHistory,$userId,BombHistory::TYPES['winnerReward']);
                    break;
                case  'start_tournament_notification':
                    $tournament = Tournament::first();
                    NotificationsService::tournamentStatusChange('tournament_started', $tournament, $userId);
                    break;
                case  'tournament_joined':
                    $tournament = Tournament::first();
                    NotificationsService::joinTournamentNotification($tournament, $userId);
                    break;
                case  'bombs_refund':
                    $tournament = Tournament::first();
                    $refund = BombHistory::first();
                    NotificationsService::bombsRefund($tournament, $userId, $refund);
                    break;
                case  'tournament_canceled':
                    $tournament = Tournament::first();
                    $refund = BombHistory::first();
                    NotificationsService::tournamentWasCanceled($tournament, $userId, $refund);
                    break;
                case  'join_tournament_invitation':
                    $tournament = Tournament::first();
                    NotificationsService::joinInvitation($tournament, $userId);
                    break;
                case  'tournament_will_start_soon':
                    $tournament = Tournament::first();
                    NotificationsService::tournamentWillStartSoon($tournament, $userId);
                    break;
                case  'team_kicked':
                    $tournament = Tournament::first();
                    $refund = BombHistory::first();
                    NotificationsService::teamKickedUser($tournament, $userId, $refund);
                    break;
                case  'match_is_finished':
                    $match = Match::first();
                    NotificationsService::matchIsFinished($match, $userId);
                    break;
                case  'result_conflict':
                    $match = Match::first();
                    NotificationsService::resultConflict($match, $userId);
                    break;
                case  'match_win':
                    $match = Match::first();
                    NotificationsService::matchWin($match, $userId);
                    break;
                case  'create_match':
                    $match = Match::first();
                    NotificationsService::createMatch($match, $userId);
                    break;
                case  'host_creating_match':
                    $host = User::first();
                    NotificationsService::hostIsCreatingMatch($host, $userId);
                    break;
                case  'join_match':
                    $match = Match::first();
                    NotificationsService::joinMatch($match, $userId);
                    break;
                case  'match_loose':
                    $match = Match::first();
                    NotificationsService::matchLoose($match, $userId);
                    break;
                case  'match_will_start_soon':
                    $match = Match::first();
                    NotificationsService::matchWillStartSoon($match, $userId);
                    break;
                default:break;
            }
        });

        return $form;
    }
}
