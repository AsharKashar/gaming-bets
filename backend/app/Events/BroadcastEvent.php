<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BroadcastEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $actionData;

    /**
     * ActionEvent constructor.
     * @param $actionData
     */
    public function __construct($actionData)
    {
        $this->actionData = $actionData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('broadcast');
    }

    public function broadcastWith()
    {
        return [
            'actionData' => $this->actionData,
        ];
    }

    public function broadcastAs()
    {
        return 'broadcast';
    }
}
