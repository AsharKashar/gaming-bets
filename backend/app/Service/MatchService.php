<?php


namespace App\Service;


use App\Jobs\MatchBeforeStartJob;
use App\Jobs\MatchEndJob;
use App\Jobs\MatchStartJob;
use App\Jobs\MatchStartNotification;
use App\Model\Match;
use App\Service\Match\MatchDelays;
use Carbon\Carbon;

class MatchService
{
    protected MatchDelays $matchDelays;

    protected Match $match;

    /**
     * @param  Match  $match
     * @return MatchService
     */
    public function setMatch(Match $match): MatchService
    {
        $this->match = $match;
        $this->matchDelays = new MatchDelays($match);
        return $this;
    }

    public function createMatchJobs()
    {
        $this
            ->beforeMatchStartJob()
            ->startMatchJob()
            ->endMatchJob()
        ;
    }

    private function beforeMatchStartJob()
    {
        $job = new MatchBeforeStartJob($this->match);
        if ($this->matchDelays->beforeStart > 0) {
            $job = $job->delay($this->matchDelays->beforeStart);
        }
        $job->onQueue('bangergames');
        dispatch($job);

        return $this;
    }

    private function startMatchJob()
    {
        $job = (new MatchStartJob($this->match))
            ->delay($this->matchDelays->startAt)
            ->onQueue('bangergames')
        ;

        dispatch($job);

        return $this;
    }

    private function endMatchJob()
    {
        $delay = Carbon::parse($this->matchDelays->endAtMax)->addMinutes(10);

        $job = (new MatchEndJob($this->match))
            ->delay($delay)
            ->onQueue('bangergames')
        ;

        dispatch($job);

        return $this;
    }

    public function matchWillBeStartedSoon()
    {
        $delay = $this->matchDelays->beforeStartNotification;
        $job = (new MatchStartNotification($delay, $this->match))
            ->onQueue('bangergames');
        dispatch($job);

        return $this;
    }
}
