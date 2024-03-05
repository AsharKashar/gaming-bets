<?php


namespace App\Model;


use Illuminate\Notifications\Notifiable;

class Slack
{
    use Notifiable;

    public function routeNotificationForSlack()
    {
        return config('services.slack.membership');
    }
}
