<?php

namespace App\Observers;

use App\Model\Status;
use App\Model\Tournament;
use App\Service\BracketService;
use App\Service\TournamentService;
use Log;

class TournamentObserver
{
    private BracketService $bracketService;

    /**
     * TournamentObserver constructor.
     * @param  BracketService  $bracketService
     */
    public function __construct(BracketService $bracketService)
    {
        $this->bracketService = $bracketService;
    }


    /**
     * Handle the tournament "created" event.
     *
     * @param  Tournament  $tournament
     * @return void
     */
    public function created(Tournament $tournament)
    {
        TournamentService::createTournamentPrizes($tournament);
        TournamentService::createTournamentJobs($tournament);
    }

    /**
     * Handle the tournament "updating" event.
     *
     * @param  Tournament  $tournament
     * @return void
     */
    public function updating(Tournament $tournament)
    {
        $tournamentSizeWasChanged = (int) $tournament['tournament_size_id'] !== (int) $tournament->getOriginal('tournament_size_id');
        $tournamentEntryFeeWasChanged = (int) $tournament['entry_fee_id'] !== (int) $tournament->getOriginal('entry_fee_id');
        $tournamentStatusWasChanged = (int) $tournament['status_id'] !== (int) $tournament->getOriginal('status_id');

        if ($tournamentSizeWasChanged || $tournamentEntryFeeWasChanged) {
            TournamentService::createTournamentPrizes($tournament);
        }

        if ($tournamentStatusWasChanged) {
            TournamentService::notifyOnStatusChange($tournament);
        }
    }

    /**
     * @param  Tournament  $tournament
     */
    public function updated(Tournament $tournament)
    {
        $tournamentStatusWasChanged = (int) $tournament['status_id'] !== (int) $tournament->getOriginal('status_id');
        if ($tournamentStatusWasChanged) {
            $this->bracketService->setTournament($tournament);
            switch ((int) $tournament['status_id']) {
                case Status::getIdByTournamentType(Status::TOURNAMENT_TYPES['full']):
                    $this->bracketService->validateTournament();
                    break;
                case Status::getIdByTournamentType(Status::TOURNAMENT_TYPES['finish_registration']):
                    $this->bracketService
                        ->validateTournament()
                        ->generateStructure()
                        ->mixtureFirstRound();
                    break;
                case Status::getIdByTournamentType(Status::TOURNAMENT_TYPES['ended']): {
                    if ($this->bracketService->isRoundEnded($this->bracketService->getFinalRound())) {
                        TournamentService::rewardTournamentWinners($tournament);
                    }
                }
                    break;
                default:break;
            }
        }
    }
}
