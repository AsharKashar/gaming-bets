<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEvent extends MasterEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @return Channel|Channel[]
     */
    public function broadcastOn()
    {
        return new Channel('App.User.' . $this->userId);
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'UserEvent';
    }

    public function broadcastWith()
    {
        return $this->notificationObj->toArray();
    }
}
