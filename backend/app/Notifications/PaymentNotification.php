<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification
{
    use Notifiable;

    private $user;
    private $card;
    private $package;
    // private $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $card, $package)
    {
        //
        $this->user = $user;
        $this->card = $card;
        $this->package = $package;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                ->success()
                ->content('User purchased a new Bomb Package!')
                ->attachment(function ($attachment){
                    $attachment->title('Time:       '.Carbon::now()->format('d-m-Y g:i A').' UTC')
                               ->fields([
                                    'ENV' => config('services.environment.env'),
                                    'URL' => config('services.environment.url'),
                                    'User ID' => $this->user->id,
                                    'Title' => $this->user->name,
                                    'Email' => $this->user->email,
                                    'Amount' => $this->package->price.' €',
                                    'Bombs' => $this->package->bombs,
                                    'Free Bombs' => $this->package->free_bombs,
                                    'Card' => 'xxxx-xxxx-xxxx-'.$this->card['last_four'],
                                    'Card Brand' => $this->card['brand'],

                                ]);
                });
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
