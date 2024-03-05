<?php

namespace App\Observers;

use App\Model\BombHistory;
use App\Model\UserBombs;
use App\Service\NotificationsService;

/**
 * Class BombHistoryObserver
 * @package App\Observers
 */
class BombHistoryObserver
{
    /**
     * @param BombHistory $bombHistory
     */
    public function created(BombHistory $bombHistory)
    {
        $userBombs = UserBombs::firstWhere('user_id', $bombHistory->user_id);
        if ($userBombs) {
            $userBombs->update(
                [
                    'bombs_paid' => $userBombs->bombs_paid + $bombHistory->bombs_paid,
                    'bombs_free' => $userBombs->bombs_free + $bombHistory->bombs_free,
                    'bombs_reward' => $userBombs->bombs_reward + $bombHistory->bombs_reward,
                ]
            );
        } else {
            UserBombs::create(
                [
                    'user_id' => $bombHistory->user_id,
                    'bombs_paid' => $bombHistory->bombs_paid ?? 0,
                    'bombs_free' => $bombHistory->bombs_free ?? 0,
                    'bombs_reward' => $bombHistory->bombs_reward ?? 0,
                ]
            );
        }

        switch ($bombHistory->type){
            case BombHistory::TYPES['winnerReward']:{
                NotificationsService::winNotification($bombHistory);
                break;
            }
            default:break;
        }
    }
}
