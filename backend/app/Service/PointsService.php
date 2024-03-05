<?php
namespace App\Service;

class PointsService
{
    public static function setUsersPointsForMatch($match){
        $tournament = $match->tournament;

        switch ($tournament->teamSize->size) {
            case 5: CommonFiveVsFiveService::setUsersPointsForMatch($match); break;
            default:
                break;
        }
    }

}
