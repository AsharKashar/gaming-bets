<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class SlackNotification extends Notification
{
    use Notifiable;

    private $user;
    private $card;
    private $membership;
    private $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $card, $membership, $type)
    {
        $this->user = $user;
        $this->card = $card;
        $this->membership = $membership;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        if($this->type == 'new'){
            return (new SlackMessage)
                ->success()
                ->content('User subscribed to a membership package!')
                ->attachment(function ($attachment){
                    $attachment->title('Time:       '.Carbon::now()->format('d-m-Y g:i A').' UTC')
                               ->fields([
                                    'ENV' => config('services.environment.env'),
                                    'URL' => config('services.environment.url'),
                                    'User ID' => $this->user->id,
                                    'Title' => $this->user->name,
                                    'Email' => $this->user->email,
                                    'Amount' => $this->membership->pay.' €',
                                    'Membership Package' => $this->membership->name,
                                    'Subscription Type' => 'Monthly',
                                    'Card' => 'xxxx-xxxx-xxxx-'.$this->card['last_four'],
                                    'Card Brand' => $this->card['brand'],

                                ]);
                });
        }

        if($this->type == 'upgrade'){
            return (new SlackMessage)
                ->success()
                ->content('User changed his membership package!')
                ->attachment(function ($attachment){
                    $attachment->title('Time:       '.Carbon::now()->format('d-m-Y g:i A').' UTC')
                               ->fields([
                                    'ENV' => config('services.environment.env'),
                                    'URL' => config('services.environment.url'),
                                    'User ID' => $this->user->id,
                                    'Title' => $this->user->name,
                                    'Email' => $this->user->email,
                                    'Subscription Type' => 'Monthly',
                                    'Previous Membership Package' => $this->membership['previous_package'],
                                    'Previous Amount' => $this->membership['previous_payment'].' €',
                                    'New Membership Package' => $this->membership['new_package'],
                                    'New Amount' => $this->membership['new_payment'].' €',
                                    'Card' => 'xxxx-xxxx-xxxx-'.$this->card['last_four'],
                                    'Card Brand' => $this->card['brand'],

                                ]);
                });
        }

        if($this->type == 'cancel'){
            return (new SlackMessage)
                ->error()
                ->content('User cancelled his subscription to membership package!')
                ->attachment(function ($attachment){
                    $attachment->title('Time:       '.Carbon::now()->format('d-m-Y g:i A').' UTC')
                               ->fields([
                                    'ENV' => config('services.environment.env'),
                                    'URL' => config('services.environment.url'),
                                    'User ID' => $this->user->id,
                                    'Title' => $this->user->name,
                                    'Email' => $this->user->email,
                                    // 'Amount' => $this->membership->pay.' €',
                                    'Membership Package' => $this->membership->name,
                                    // 'Subscription Type' => 'Monthly',
                                    // 'Card' => 'xxxx-xxxx-xxxx-'.$this->card['last_four'],
                                    // 'Card Brand' => $this->card['brand'],

                                ]);
                });
        }

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
