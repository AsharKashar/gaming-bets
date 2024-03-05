<?php

namespace App\Jobs;

use App\Service\NotificationsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MatchStartNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationDelay;
    protected $match;

    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @param $notificationDelay
     * @param $match
     */
    public function __construct($notificationDelay, $match)
    {
        $this->notificationDelay = $notificationDelay;
        $this->match = $match;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->notificationDelay <= 15*60) {
            NotificationsService::matchWillStartSoon($this->match);
        } else {
            $job = (new MatchStartNotification($this->notificationDelay, $this->match))
                ->delay($this->notificationDelay)
                ->onQueue('bangergames');
            dispatch($job);
        }
    }
}
