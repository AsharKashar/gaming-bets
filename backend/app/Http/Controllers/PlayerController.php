<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportIssueRequest;
use App\Http\Requests\TransferRequest;
use App\Model\PaymentHistory;
use App\Model\ReportIsuue;
use App\Model\Tournament;
use App\Model\TournamentResult;
use App\Model\User;
use App\Model\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PlayerController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function show()
    {
        $user = User::where("id", auth()->id())->first();
        $tournaments = Tournament::leftjoin("tournament_results", "tournament_results.tournament_id", "tournaments.id")
            ->leftjoin("tournament_user", "tournament_user.tournament_id", "tournaments.id")
            ->where("tournament_user.user_id", auth()->id())->latest('tournament_results.created_at')->get();
        $user->tournaments = $tournaments->groupBy('status');
//        $point = 0;
//        $prize = 0;
//        if (isset($user->tournaments['ended'])) {
//            foreach ($user->tournaments['ended'] as $tour) {
//                if ($tour->first_place == auth()->id()) {
//                    $point += $tour->first_points;
//                    $prize += $tour->first_prize;
//                } elseif ($tour->second_place == auth()->id()) {
//                    $point += $tour->second_points;
//                    $prize += $tour->second_prize;
//                } elseif ($tour->third_place == auth()->id()) {
//                    $point += $tour->third_points;
//                    $prize += $tour->third_prize;
//                }
//            }
//        }
//        $user->total_points = $point;
        $user->total_prize = $user->total_bomb();
        $user->wins = UserPoint::where('user_id', auth()->id())->count();
        return view("user")->with('user', $user);
    }

    public function show1()
    {
        $user = User::where("id", auth()->id())->first();
        $tournaments = Tournament::leftjoin("tournament_results", "tournament_results.tournament_id", "tournaments.id")
            ->leftjoin("tournament_user", "tournament_user.tournament_id", "tournaments.id")
            ->where("tournament_user.user_id", auth()->id())->latest('tournament_results.created_at')->get();
        $user->tournaments = $tournaments->groupBy('status');
        $point = 0;
        $prize = 0;
        if (isset($user->tournaments['ended'])) {
            foreach ($user->tournaments['ended'] as $tour) {
                if ($tour->first_place == auth()->id()) {
                    $point += $tour->first_points;
                    $prize += $tour->first_prize;
                } elseif ($tour->second_place == auth()->id()) {
                    $point += $tour->second_points;
                    $prize += $tour->second_prize;
                } elseif ($tour->third_place == auth()->id()) {
                    $point += $tour->third_points;
                    $prize += $tour->third_prize;
                }
            }
        }
        $user->total_points = $point;
        $user->total_prize = $user->total_bomb();
        return view("cash-withdrawal")->with('user', $user);
        return $user;
    }

    public function user_profile($user_id)
    {
        $user = User::find($user_id);
        $tournaments = Tournament::leftjoin("tournament_results", "tournament_results.tournament_id", "tournaments.id")
            ->leftjoin("tournament_user", "tournament_user.tournament_id", "tournaments.id")
            ->where("tournament_user.user_id", $user_id)->latest('tournament_results.created_at')->get();
        $user->tournaments = $tournaments->groupBy('status'); //TODO: fix this
        $point = 0;
        $prize = 0;

        if (isset($user->tournaments['ended'])) {
            foreach ($user->tournaments['ended'] as $tour) {
                if ($tour->first_place == $user_id) {
                    $point += $tour->first_points;
                    $prize += $tour->first_prize;
                } elseif ($tour->second_place == $user_id) {
                    $point += $tour->second_points;
                    $prize += $tour->second_prize;
                } elseif ($tour->third_place == $user_id) {
                    $point += $tour->third_points;
                    $prize += $tour->third_prize;
                }
            }
        }
        $user->total_points = $point;
        $user->total_prize = $prize;

        $winning_perc = 0;
        $standing = 0;
        if (isset($user->tournaments['ended'])) {
            $total_tournaments = count($user->tournaments['ended']);
            $total_win_tour = TournamentResult::where(
                function ($q) use ($user_id) {
                    $q->where("first_place", $user_id)
                        ->orWhere("second_place", $user_id)
                        ->orWhere("third_place", $user_id);
                }
            )->get();
            $winning_perc = round((count($total_win_tour) / $total_tournaments) * 100);
        }
        $ladder = UserPoint::select("user_id")->selectRaw("IFNULL(SUM(user_points.points),0) as points")
            ->selectRaw("IFNULL(SUM(user_points.winning),0) as winning")
            ->orderBy("winning", "desc")
            ->orderBy("points", "desc")
            ->groupBy("user_id")->get();
        if (array_search($user_id, $ladder->pluck('user_id')->toArray()) !== false) {
            $standing = array_search($user_id, $ladder->pluck('user_id')->toArray()) + 1;
        }
        $user->standing = $standing;
        $user->winning_perc = $winning_perc;
        return view('user_profile')->with('user', $user);
    }

    public function update(Request $request)
    {
        $password = User::select('password')->where('id', auth()->id())->value('password');
        if (Hash::check(request()->get('password'), $password)) {
            User::where('id', auth()->id())->update(
                [
                    'name' => $request->name,
                ]
            );
            return back()->with('msg', 'Profile Updated successfully');
        } else {
            return back()->with('msg', 'Invalid Password');
        }
    }

    public function transfer(TransferRequest $request)
    {
//        $holderName = $request->get('holder_name');
//        $holder_type = $request->get('holder_type');
//        $routing = $request->get('routing');
//        $number = $request->get('account_number');
        $destination = $request->get('destination');
        $amount = $request->get('amount');
        $user_id = auth()->id();
        $bomb = -$amount;

        if (auth()->user()->total_bomb() >= $amount) {
            $result = $this->stripeTransfer(
                $destination,
                $amount,
                function () use ($bomb, $user_id) {
                    PaymentHistory::create(
                        [
                            "user_id" => $user_id,
                            "pay" => 0,
                            "tournament_id" => null,
                            "bomb" => $bomb,
                            "withdrawal" => true,
                        ]
                    );
                }
            );

            if ($request['type'] == 'exception') {
                dd($result);
            } else {
                return back()->with('msg', $result['msg']);
            }
        }


        return back()->with('msg', 'You Dont have enough Bomb for transfer');
    }

    public function reportIssue(ReportIssueRequest $request)
    {
        $report = ReportIsuue::addUpdate($request->all());
        if ($report) {
            return back()->with('msg', 'Stored Successfully');
        }
        return back()->with('msg', 'Couldn\'t store your request try again later');
    }
}
