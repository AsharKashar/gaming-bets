<?php


namespace App\Service\Match;


use App\Model\Match;
use Carbon\Carbon;

class MatchDelays
{
    public int $beforeStart;
    public int $beforeStartNotification;
    public int $startAt;
    public int $endAtMin;
    public int $endAtMax;

    /**
     * MatchDelays constructor.
     * @param  Match  $match
     */
    public function __construct(Match $match)
    {
        $notificationTimeShift = 15 * 60;

        $this->beforeStart = $match->start_at? $match->start_at->subMinutes(30)->diffInSeconds(Carbon::now()) : 0; // before 30 minutes
        $this->beforeStartNotification = Carbon::now()->diffInSeconds($match->start_at, false) - $notificationTimeShift;
        $this->startAt = $match->start_at?$match->start_at->diffInSeconds(Carbon::now()):0;
        $this->endAtMin = $match->end_at_min ? $match->end_at_min->addMinutes($match->tournament->gameMode->matchLimits->min)->diffInSeconds(Carbon::now()) : 0;
        // TODO: send request to dathost after endAtMax
        $this->endAtMax = $match->end_at_max? $match->end_at_max->addMinutes($match->tournament->gameMode->matchLimits->max)->diffInSeconds(Carbon::now()) : 0;
    }
}
