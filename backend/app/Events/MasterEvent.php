<?php

namespace App\Events;

use App\Model\User;
use App\Model\UserNotification;

class MasterEvent
{
    protected string $reason;
    protected array $data;
    protected $userId;
    protected $forceModal;
    protected $notificationObj;

    /**
     * Create a new event instance.
     * @param string $reason
     * @param array $data
     * @param int|null $userId
     * @return void
     */
    public function __construct($reason, $data=[], $userId=null, $forceModal=false)
    {
        $this->reason = $reason;
        $this->data = $data;
        $this->userId = $userId;
        $this->$forceModal = $forceModal;

        if ($userId) {
            $this->notificationObj = UserNotification::create([
                'reason' => $reason,
                'user_id' => $userId,
                'data' => $data,
                'force_modal' => $forceModal
            ]);
        }
        //TODO:: This is broadcast notification, not sure if we need to save it, but if it is necessary, uncomment code below
        /*
        if (!$userId) {
            $users = User::all();
            foreach ($users as $user) {
                UserNotification::create([
                    'title' => $title,
                    'user_id' => $user->id,
                    'data' => $data
                ]);
            }
        }
        */
    }

}
