<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;


/**
 * Class SlackPayment
 * @package App\Model
 */
class SlackPayment
{
    use Notifiable;

    public function routeNotificationForSlack()
    {
        return config('services.slack.webhook');
    }
}
