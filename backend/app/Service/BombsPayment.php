<?php

namespace App\Service;


use App\Model\BombHistory;
use App\Model\PaymentHistory;
use App\Model\User;
use Exception;

class BombsPayment
{

    public static function buyBombsTournament(int $userId, float $pay = 0, float $bombPaid = 0,float $bombsReward = 0,  float $bombsFree = 0, string $responsePay)
    {
        PaymentHistory::create([
            "user_id" => $userId,
            "pay" => $pay,
            "response_pay" => $responsePay,
        ]);

        BombHistory::create([
            'user_id' => $userId,
            'bombs_paid' => $bombPaid,
            'bombs_reward' => $bombsReward,
            'bombs_free' => $bombsFree,
            'type' => BombHistory::TYPES['buyBombs'],
            'pay' => ['type' => BombHistory::TYPES['buyBombs']],
        ]);
    }

    public static function AwardUser(int $userId, string $type, float $bombsPaid = 0, float $bombsReward = 0,  float $bombsFree = 0, int $tournamentId)
    {
        BombHistory::create([
            'user_id' => $userId,
            'bombs_paid' => $bombsPaid,
            'bombs_reward' => $bombsReward,
            'bombs_free' => $bombsFree,
            'type' =>  $type,
            'pay' => [$type => $tournamentId],
        ]);
    }

    public static function RefundUser(int $userId, string $type, int $tournamentId)
    {
        $UserHistory = BombHistory::where('user_id', $userId)->where('type', $type)->get();
        foreach($UserHistory as $record){
            $temp = $record->pay;
            if($temp[$type] == $tournamentId){
                $bombUse = $record;
            }
        }
        BombHistory::create([
            'user_id' => $userId,
            'bombs_paid' => $bombUse->bombs_paid,
            'bombs_reward' => $bombUse->bombs_reward,
            'bombs_free' => $bombUse->bombs_free,
            'type' =>  $type,
            'pay' => [$type => $tournamentId],
        ]);
    }


    /**
     * @param User $user
     * @param float $price
     * @param string $type
     * @param number|string|null $pay
     * @return string
     */
    public static function userPayBombs(User $user, float $price, string $type, $pay)
    {
        if (!$user->bomb) {
            return 'not_money';
        }
        $userBombPaid = $user->bomb->bombs_paid;
        $userBombsReward = $user->bomb->bombs_reward;
        $userBombsFree = $user->bomb->bombs_free;

        if ($userBombPaid + $userBombsReward + $userBombsFree >= $price) {

            if ($userBombPaid >= $price) {
                $userBombPaid = $price * (-1);
                $userBombsReward  = 0;
                $userBombsFree = 0;
            } else {
                $price = $price - $userBombPaid;
                $userBombPaid = $userBombPaid * (-1);
                if ($price > 0 && $userBombsReward >= $price) {
                    $userBombsReward = $price * (-1);
                    $userBombsFree = 0;
                } else {
                    $price = $price - $userBombsReward;
                    $userBombsReward = $userBombsReward * (-1);
                    if ($price > 0) {
                        $userBombsFree = $price * (-1);
                    }
                }
            }


            try {
                BombHistory::create([
                    'user_id' => $user->id,
                    'bombs_paid' => $userBombPaid ,
                    'bombs_reward' => $userBombsReward,
                    'bombs_free' => $userBombsFree,
                    'type' => $type,
                    'pay' => [$type => $pay],
                ]);
            } catch (Exception $e) {
                return 'not_create';
            }
            return 'success';
        }
        return 'not_money';
    }

    public static function checkIfUserHasBombs(User $user, float $price)
    {
        if (!$user->bomb) {
            return false;
        }
        $userBombPaid = $user->bomb->bombs_paid;
        $userBombsReward = $user->bomb->bombs_reward;
        $userBombsFree = $user->bomb->bombs_free;

        if ($userBombPaid + $userBombsReward + $userBombsFree >= $price) {
            return true;
        }
        return false;
    }

    public static function getUserBombs(User $user)
    {
        if (!$user->bomb) {
            return 0;
        }
        $userBombPaid = $user->bomb->bombs_paid;
        $userBombsReward = $user->bomb->bombs_reward;
        $userBombsFree = $user->bomb->bombs_free;

        return $userBombPaid + $userBombsReward + $userBombsFree;
    }
    public static function returnUserBomb(int $userId,string $type, array $pay) {
        $bombHistory = BombHistory::whereJsonContains('pay', $pay)->where(['user_id' => $userId, 'type' => $type])
            ->orderBy('updated_at', 'desc')->first();
        if(!$bombHistory) {
            return 'not_history';
        }

        $newBombHistory = array_merge($bombHistory->toArray(), [
            'bombs_paid' => $bombHistory['bombs_paid'] * (-1),
            'bombs_reward' => $bombHistory['bombs_reward'] * (-1),
            'bombs_free' => $bombHistory['bombs_free'] * (-1),
        ]);

        return BombHistory::create($newBombHistory);
    }
}
