<?php

namespace App\Observers;

use App\Model\UserPointsHistory;

/**
 * Class UserPointsHistoryObserver
 * @package App\Observers
 */
class UserPointsHistoryObserver
{
    /**
     * @param UserPointsHistory $userPointsHistory
     */
    public function created(UserPointsHistory $userPointsHistory)
    {
        $userPointsHistory->user->addPoints($userPointsHistory->points);
    }
}
