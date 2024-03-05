@extends('layout.mainlayout')
@push('css')
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap-datepicker.min.css")}}">
    <style>
        .color-gold {
            color: gold;
        }
    </style>
@endpush
@section('content')

    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area bc-tournaments" style="padding: 220px 0px 0px;">
        <img class="bc-img" src="assets/images/breadcrumb/tournaments.png" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="title">
                        Tournaments
                    </h4>
                    <ul class="breadcrumb-list">
                        <li>
                            <a href="/index">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <span><i class="fas fa-chevron-right"></i> </span>
                        </li>
                        <li>
                            <a href="/tournaments">FORTNITE</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->
    <!-- Tournaments Area Start -->
    <section class="tournaments">
        <!--<div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="section-heading">
                            <h5 class="subtitle">
                                Try to check out our
                            </h5>
                            <h2 class="title">
                                Tournaments!
                            </h2>
                            <p class="text">
                                Dooplo Tournaments are exciting slot competitions. The goal is to win as many points within a
                                certain amount of time. Player with the most points at the end wins.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="tournament-time-box">
                            <div class="top-area">
                                <div class="status">
                                    In Progress
                                </div>
                                <h4 class="title">
                                    All Players (Excl VIP's)
                                </h4>
                                <p class="sub-title">
                                    Slots Tournament
                                </p>
                            </div>
                            <div class="timer-area">
                                <h4 class="title">
                                    Ending in
                                </h4>
                                <div class="clock"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="tournament-time-box">
                            <div class="top-area">
                                <div class="status">
                                    In Progress
                                </div>
                                <h4 class="title">
                                    VIP Only
                                </h4>
                                <p class="sub-title">
                                    Slots Tournament
                                </p>
                            </div>
                            <div class="timer-area">
                                <h4 class="title">
                                    Ending in
                                </h4>
                                <div class="clock2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        <div class="info-table">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <!--<div class="main-header-area">
                                <ul class="nav" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-all-player-tab" data-toggle="pill"
                                            href="#pills-all-player" role="tab" aria-controls="pills-all-player"
                                            aria-selected="true">All Player</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-vip-only-tab" data-toggle="pill"
                                            href="#pills-vip-only" role="tab" aria-controls="pills-vip-only"
                                            aria-selected="false">Vip Only</a>
                                    </li>
                                </ul>
                            </div>-->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pills-all-player" role="tabpanel"
                                    aria-labelledby="pills-all-player-tab">
                                    <div class="inner-table-content">
                                        <div class="header-area">
                                            <ul class="nav" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link {{$tournament->type=="user"?"active" : ''}}" id="Overview-tab" data-toggle="tab" href="#Overview" role="tab"
                                                        aria-controls="Overview" aria-selected="false">Overview</a>
                                                </li>
                                                @if(strtoupper($tournament->game->name) == "CALL OF DUTY")
                                                    <li class="nav-item">
                                                        <a class="nav-link " id="Player-tab" data-toggle="tab" href="#Player" role="tab"
                                                            aria-controls="Player" aria-selected="false">Players</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link {{$tournament->type=="team"?"active" : ''}}" id="Bracket-tab" data-toggle="tab" href="#Bracket" role="tab"
                                                            aria-controls="Bracket" aria-selected="true">Bracket</a>
                                                    </li>
                                                    @auth
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="team-matches-tab" data-toggle="tab" href="#team-matches" role="tab"
                                                                aria-controls="team-matches" aria-selected="false">Team Matches</a>
                                                        </li>
                                                    @endauth
                                                @endif
                                                <li class="nav-item">
                                                    <a class="nav-link " id="Rules-tab" data-toggle="tab" href="#Rules" role="tab"
                                                        aria-controls="Rules" aria-selected="false">Rules</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="Player" role="tabpanel" aria-labelledby="Player-tab">
                                                @if ($tournament->type == 'team')
                                                    <?php
                                                    $teams = $tournament->teams()->with('members')->get();

                                                    ?>
                                                    @foreach($teams as $team)
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="single-winer">
                                                                    <div class="top-area">
                                                                        @foreach($team->members as $member)
                                                                            <div class="left">
                                                                                <h4 class="name" style="font-size: 18px">
                                                                                    <a>{{$member->name}}</a>
                                                                                </h4>
                                                                                {{--                                                                    <p class="date">--}}
                                                                                {{--                                                                        10-1-2020--}}
                                                                                {{--                                                                    </p>--}}
                                                                            </div>
                                                                            <div class="right">
                                                                                <p class="id">#{{$member->pivot->activision}}</p>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="bottom-area">
                                                                        <div class="left">
                                                                            {{$team->name}}
                                                                        </div>
                                                                        <div class="right">

                                                                            <img src="assets/images/icon2.png" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach

                                                        </div>
                                                        @endif
                                            </div>
                                            <div class="tab-pane fade  {{$tournament->type=="team"?"show active" : ''}}" id="Bracket" role="tabpanel" aria-labelledby="Bracket-tab">
                                                <section class="team">
                                                    <div class="top-area">
                                                        <div class="container">
                                                            <div class="row justify-content-center">
                                                                <div class="col-lg-8 col-md-10">
                                                                    <div class="section-heading">
                                                                        <h5 class="subtitle">
                                                                            OVERVIEW OF Matches
                                                                        </h5>

                                                                        <div class="matchBracket"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane fade {{$tournament->type=="user"?"show active" : ''}}" id="Overview" role="tabpanel" aria-labelledby="Overview-tab">
                                                <!-- <div class="accordion sorteo-accordion" id="accordionExample5">-->
                                                <!-- Team Area Start -->
                                                <section class="team">
                                                    <div class="top-area">
                                                        <div class="container">
                                                            <div class="row justify-content-center">
                                                                <div class="col-lg-8 col-md-10">
                                                                    <div class="section-heading">
                                                                        <h5 class="subtitle">
                                                                            OVERVIEW OF FORTNITE Tournament
                                                                        </h5>
                                                                        <h2 class="title">
                                                                            {{$tournament->name}}
                                                                        </h2>
                                                                        <p class="text">

                                                                            @if ($tournament->hosted_by)
                                                                                TOURNAMENT HOSTED BY
                                                                                <b class="text-danger">{{$tournament->hosted_by}}</b>
                                                                                <br>
                                                                        @endif

                                                                        @guest
                                                                            <h4>Please First Register to join tournament</h4>
                                                                        @endguest

                                                                        @auth
                                                                            @if ($tournament->status == 'up_coming' && $tournament->reg_end_at > now())
{{--                                                                                @if ($tournament->type == 'user')--}}
{{--                                                                                    <div class="mb-4">--}}
{{--                                                                                        <button class="btn btn-lg mt-5 btn-invite btn-danger rounded-pill" data-toggle="modal" data-link="{{route('tournament.details',$tournament->id)}}" data-target="#invite-link">--}}
{{--                                                                                            <i class="fa fa-user-alt"></i> Invite--}}
{{--                                                                                        </button>--}}
{{--                                                                                    </div>--}}
{{--                                                                                @elseif($tournament->type == 'team')--}}
                                                                                    @if(\App\Tournament::playerHasTeam($tournament->id,auth()->id()))
                                                                                        <div class="mb-2">
                                                                                            <button class="btn btn-lg btn-danger rounded-pill" data-toggle="modal" data-target="#team-member">
                                                                                                <i class="fa fa-user-alt"></i> Your Team
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="mb-2">
                                                                                            <button class="btn btn-lg btn-danger rounded-pill" data-toggle="modal" data-target="#invite-link">
                                                                                                <i class="fa fa-user-alt"></i> Invite members to join your team
                                                                                            </button>
                                                                                        </div>
                                                                                    @elseif($tournament->hasMultipleMembers)
                                                                                        <div class="form-group">
                                                                                            <button class="btn btn-lg btn-danger rounded-pill" data-toggle="modal" data-target="#join-team">
                                                                                                <i class="fa fa-user-alt"></i> Join Team & Tournament
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="mb-2">
                                                                                            <button class="btn btn-lg btn-danger rounded-pill" data-toggle="modal" data-target="#make-team">
                                                                                                <i class="fa fa-user-alt"></i> Make Your Team And Join Tournament
                                                                                            </button>
                                                                                        </div>
                                                                                    @else
                                                                                    <div class="mb-2">
                                                                                        <button class="btn btn-lg btn-danger rounded-pill" data-toggle="modal" data-target="#make-team">
                                                                                            <i class="fa fa-user-alt"></i> Make Your Team And Join Tournament
                                                                                        </button>
                                                                                    </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endif

                                                                            @if($tournament->status == 'check_in' && !auth()->user()->isCheckedIn($tournament->id) )
                                                                                <a href="{{route('check_in.tournament',$tournament->id)}}" class="btn btn-lg mt-5 btn-danger rounded-pill">
                                                                                    <i class="fa fa-check"></i> Check In to tournament
                                                                                </a>
                                                                            @elseif($tournament->status == 'check_in' && auth()->user()->isCheckedIn($tournament->id))
                                                                                <p>Your have checked In</p>
                                                                            @endif
                                                                        {{--
                                                                            @if(strtoupper($tournament->game->name) == "FORTNITE")
                                                                                @if ($tournament->status == 'up_coming' && $tournament->reg_end_at > now() && $tournament->bracket_size > $tournament->players->count())

                                                                                    @if (!auth()->user()->hasTournament($tournament->id))

                                                                                        @if($tournament->type == 'team')
                                                                                            <button class="btn btn-lg mt-5 btn-danger rounded-pill" data-toggle="modal" data-target="#teamname">
                                                                                                <i class="fa fa-user-plus"></i> Join
                                                                                            </button>
                                                                                        @else
                                                                                            @if (auth()->user()->free_tournament_allowed() > 0)

                                                                                                <a href="{{route('tournament.free.join',$tournament->id)}}" class="btn btn-lg mt-5 btn-danger rounded-pill">
                                                                                                    <i class="fa fa-user-plus"></i> Join
                                                                                                </a>
                                                                                            @else
                                                                                                <button class="btn btn-lg mt-5 btn-danger rounded-pill" data-toggle="modal" data-target="#payment">
                                                                                                    <i class="fa fa-user-plus"></i> Join
                                                                                                </button>
                                                                                            @endif
                                                                                        @endif
                                                                                    @else
                                                                                        <i class="text-center">Already Joined</i>
                                                                                    @endif
                                                                                @endif
                                                                            @endif

                                                                            @if(strtoupper($tournament->game->name) == "CALL OF DUTY" && !$tournament->hasMultipleMembers)
                                                                                @if ($tournament->status == 'up_coming' && $tournament->reg_end_at > now() && $tournament->bracket_size > $tournament->players->count())
                                                                                    @if (!auth()->user()->hasTournament($tournament->id))
                                                                                        @if (auth()->user()->free_tournament_allowed() > 0)

                                                                                            <a href="" class="btn btn-lg mt-5 btn-danger rounded-pill">
                                                                                                <i class="fa fa-user-plus"></i> Join
                                                                                            </a>
                                                                                        @else
                                                                                            <button class="btn btn-lg mt-5 btn-danger rounded-pill" data-toggle="modal" data-target="#activisionid">
                                                                                                <i class="fa fa-user-plus"></i> Join
                                                                                            </button>
                                                                                        @endif
                                                                                    @else
                                                                                        <i class="text-center">Already Joined</i>
                                                                                    @endif
                                                                                @endif
                                                                            @endif

                                                                            --}}
                                                                            @if(strtoupper($tournament->game->name) == "APEX")
                                                                                @if ($tournament->status == 'up_coming' && $tournament->reg_end_at > now() && $tournament->bracket_size > $tournament->players->count())
                                                                                    @if (!auth()->user()->hasTournament($tournament->id))
                                                                                        @if (auth()->user()->free_tournament_allowed() > 0)

                                                                                            <a href="{{route('tournament.free.join',$tournament->id)}}" class="btn btn-lg mt-5 btn-danger rounded-pill">
                                                                                                <i class="fa fa-user-plus"></i> Join
                                                                                            </a>
                                                                                        @else
                                                                                            <button class="btn btn-lg mt-5 btn-danger rounded-pill" data-toggle="modal" data-target="#payment">
                                                                                                <i class="fa fa-user-plus"></i> Join
                                                                                            </button>
                                                                                        @endif
                                                                                    @else
                                                                                        <i class="text-center">Already Joined</i>
                                                                                    @endif

                                                                            @endif
{{--                                                                            @endif--}}
                                                                        @endauth

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="team-members">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-13">
                                                                    <div class="team-member-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-3">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team1.jpg" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                1st place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                        <h4 class="name">
                                                                                            $ {{$tournament->first_prize}}
                                                                                        </h4>
                                                                                        {{--                                                                                        <p class="name">--}}
                                                                                        {{--                                                                                            ${{$tournament->first_prize/config('setting.team_size')}}--}}
                                                                                        {{--                                                                                        </p>--}}
                                                                                        <p class="name">
                                                                                            {{$tournament->first_points}} points
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team1.jpg" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                2nd place
                                                                                            </h4>
                                                                                            <!-- <div class="designation">
                                                                                                 Co-Founder & CEO
                                                                                             </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            $ {{$tournament->second_prize}}
                                                                                        </h4>
                                                                                        {{--                                                                                        <p class="name">--}}
                                                                                        {{--                                                                                            ${{$tournament->second_prize/config('setting.team_size')}} per player--}}
                                                                                        {{--                                                                                        </p>--}}
                                                                                        <p class="name">
                                                                                            {{$tournament->second_points}} points
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                           <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team1.jpg" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                3rd place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            $ {{$tournament->third_prize}}
                                                                                        </h4>
                                                                                        {{--                                                                                        <p class="name">--}}
                                                                                        {{--                                                                                            ${{$tournament->third_prize/config('setting.team_size')}} per player--}}
                                                                                        {{--                                                                                        </p>--}}
                                                                                        <p class="name">
                                                                                            {{$tournament->third_points}} points
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--<div class="col-lg-3 col-md-6">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team4.png" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                FORTNITE
                                                                                            </h4>
                                                                                            <div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--2nd row-->
                                                            <br><br><br><br><br><br><br><br>
                                                            <div class="row">
                                                                <div class="col-lg-1"></div>
                                                                <div class="col-lg-10 text-center">
                                                                    <div class="team-member-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                1st place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                        <h4 class="name">
                                                                                            Game
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{$tournament->game ? $tournament->game->name : "" }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                2nd place
                                                                                            </h4>
                                                                                            <!-- <div class="designation">
                                                                                                 Co-Founder & CEO
                                                                                             </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            Platforms
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{$tournament->platforms ? $tournament->platforms : "PC"}}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                           <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                3rd place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            Regions
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{ $tournament->regions ? $tournament->regions : '-'}}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--<div class="col-lg-3 col-md-6">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team4.png" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                FORTNITE
                                                                                            </h4>
                                                                                            <div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--3nd row-->
                                                            <br><br><br><br><br><br>
                                                            <div class="row">
                                                                <div class="col-lg-1"></div>
                                                                <div class="col-lg-10 text-center">
                                                                    <div class="team-member-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                1st place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                        <h4 class="name">
                                                                                            Entry Fee
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{ $tournament->entry_fee }} credits
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                2nd place
                                                                                            </h4>
                                                                                            <!-- <div class="designation">
                                                                                                 Co-Founder & CEO
                                                                                             </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            Prize pool
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            $ {{ $tournament->first_prize + $tournament->second_prize + $tournament->third_prize  }}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                           <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                3rd place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            Team size
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{$tournament->team_size ? $tournament->team_size : '-' }}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--<div class="col-lg-3 col-md-6">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team4.png" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                FORTNITE
                                                                                            </h4>
                                                                                            <div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--4nd row-->
                                                            <br><br><br><br><br><br>
                                                            <div class="row">
                                                                <div class="col-lg-1"></div>
                                                                <div class="col-lg-10 text-center">
                                                                    <div class="team-member-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                1st place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                        <h4 class="name">
                                                                                            Event Start
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{$tournament->start_at->diffForHumans()}}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                2nd place
                                                                                            </h4>
                                                                                            <!-- <div class="designation">
                                                                                                 Co-Founder & CEO
                                                                                             </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            Registration open
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{$tournament->reg_start_at?$tournament->reg_start_at->diffForHumans() : ''}}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                           <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                3rd place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            Registration ends
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{$tournament->reg_end_at ? $tournament->reg_end_at->diffForHumans() : '-'}}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--<div class="col-lg-3 col-md-6">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team4.png" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                FORTNITE
                                                                                            </h4>
                                                                                            <div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--5nd row-->
                                                            <br><br><br><br><br><br>
                                                            <div class="row">
                                                                <div class="col-lg-1"></div>
                                                                <div class="col-lg-10 text-center">
                                                                    <div class="team-member-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                1st place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                        <h4 class="name">
                                                                                            Bracket size
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{ $tournament->bracket_size ? $tournament->bracket_size : 1 }}
                                                                                            teams
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                2nd place
                                                                                            </h4>
                                                                                            <!-- <div class="designation">
                                                                                                 Co-Founder & CEO
                                                                                             </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            Bracket type
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{ $tournament->bracket_type ?  $tournament->bracket_type : '-' }}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                           <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                3rd place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            {{ "Teams Registered" }}
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{ $tournament->type == 'user' ? $tournament->players->count() : $tournament->teams->count() }}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--<div class="col-lg-3 col-md-6">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team4.png" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                FORTNITE
                                                                                            </h4>
                                                                                            <div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--6th row-->
                                                            <br><br><br><br><br><br>
                                                            <div class="row">
                                                                <div class="col-lg-1"></div>
                                                                <div class="col-lg-10 text-center">
                                                                    <div class="team-member-inner">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                1st place
                                                                                            </h4>
                                                                                            <!--<div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="social-area">
                                                                                        <h4 class="name">
                                                                                            Type
                                                                                        </h4>
                                                                                        <p class="name">
                                                                                            {{ $tournament->repeat }}
                                                                                        </p>
                                                                                        <!--<ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>-->
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            @if ($tournament->type == 'team')

                                                                                <div class="col-lg-4 col-md-4">
                                                                                    <div class="single-team">
                                                                                        <div class="image">
                                                                                            <!--<img src="assets/images/team/team1.jpg" alt="">-->
                                                                                            <div class="overlay"></div>
                                                                                            <div class="content">
                                                                                                <h4 class="name">
                                                                                                    2nd place
                                                                                                </h4>
                                                                                                <!-- <div class="designation">
                                                                                                     Co-Founder & CEO
                                                                                                 </div>-->
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="social-area">
                                                                                            <h4 class="name">
                                                                                                Tournament
                                                                                            </h4>
                                                                                            <p class="name">
                                                                                                {{ $tournament->teamVS ?  $tournament->teamVS : '-' }}
                                                                                            </p>
                                                                                            <!--<ul class="social-links">
                                                                                                <li>
                                                                                                    <a href="#">Login
                                                                                                        <i class="fab fa-facebook-f"></i>
                                                                                                    </a>
                                                                                                </li>
                                                                                               <li>
                                                                                                    <a href="#">
                                                                                                        <i class="fab fa-twitter"></i>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <a href="#">
                                                                                                        <i class="fab fa-instagram"></i>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <a href="#">View
                                                                                                        <i class="fab fa-pinterest-p"></i>
                                                                                                    </a>
                                                                                                </li>
                                                                                            </ul>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        @endif

                                                                        <!--<div class="col-lg-3 col-md-6">
                                                                                <div class="single-team">
                                                                                    <div class="image">
                                                                                        <img src="assets/images/team/team4.png" alt="">
                                                                                        <div class="overlay"></div>
                                                                                        <div class="content">
                                                                                            <h4 class="name">
                                                                                                FORTNITE
                                                                                            </h4>
                                                                                            <div class="designation">
                                                                                                Co-Founder & CEO
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="social-area">
                                                                                        <ul class="social-links">
                                                                                            <li>
                                                                                                <a href="#">Login
                                                                                                    <i class="fab fa-facebook-f"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-twitter"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">
                                                                                                    <i class="fab fa-instagram"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href="#">View
                                                                                                    <i class="fab fa-pinterest-p"></i>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--<div class="row">
                                                                <div class="col-lg-12 text-center">
                                                                    <a href="#" class="mybtn1">SEE More</a>
                                                                </div>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            @auth
                                                <?php $matches = auth()->user()->userTeamMatches($tournament->id); ?>
                                                <div class="tab-pane fade" id="team-matches" role="tabpanel" aria-labelledby="team-matches-tab">
                                                    <!-- <div class="accordion sorteo-accordion" id="accordionExample5">-->
                                                    <!-- Team Area Start -->
                                                    <section class="team">
                                                        <div class="top-area">
                                                            <div class="container">

                                                                <div class="section-heading">
                                                                    <h5 class="subtitle">OVERVIEW OF YOUR TEAM'S MATCHES</h5>

                                                                    <table class="table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Title</th>
                                                                            <th>Teams</th>
                                                                            <th></th>
                                                                        </tr>
                                                                        </thead>
                                                                        @forelse ($matches as $match)
                                                                            <tr>
                                                                                <td>{{$match->title}}</td>
                                                                                <td>
                                                                                    <div>
                                                                                        @if ($match->hosted_by == $match->team_1)
                                                                                            <span class="color-gold">[ HOST ] </span>
                                                                                        @endif
                                                                                        {{$match->team1_name}}
                                                                                        <b class="fa-2x text-danger">VS</b>
                                                                                        @if ($match->hosted_by == $match->team_2)
                                                                                            <span class="color-gold">[ HOST ] </span>
                                                                                        @endif
                                                                                        {{$match->team2_name}}
                                                                                    </div>
                                                                                    <p class="text-muted">Stating Time : {{$match->start_at}}</p>
                                                                                </td>
                                                                                <td>
                                                                                    @if ($team != null)
                                                                                        @if( ($match->team_1 ==  $team->team_id && $match->close_for1 == 0 ) || ($match->team_2 ==  $team->team_id && $match->close_for2 == 0 ) )
                                                                                            <button class="btn btn-sm btn-danger" data-id="{{$match->match_id}}" data-toggle="modal" data-target="#upload-form">Upload Evidence</button>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr>
                                                                                <td colspan="3">No record found</td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </table>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </section>
                                                </div>
                                                @if ($tournament->type == 'team')
                                                    @include('modal.upload-evidence')
                                                @endif
                                            @endauth
                                            <div class="tab-pane fade" id="Rules" role="tabpanel" aria-labelledby="Rules-tab">
                                                <section class="faq-section">
                                                    <div class="faq-wrapper">
                                                        <div class="accordion sorteo-accordion" id="accordionExample4">

                                                            @forelse($rules as $key => $rule)


                                                                <div class="card">
                                                                    <div class="card-header" id="headingNine">
                                                                        <h2 class="mb-0">
                                                                            <button class="btn btn-link {{$loop->first ? '' : 'collapsed'}}" type="button" data-toggle="collapse"
                                                                                data-target="#collapse_{{$key}}" aria-expanded="{{$loop->first ? "true" : 'false'}}"
                                                                                aria-controls="collapse_{{$key}}">
                                                                                <i
                                                                                    class="fa fa-question"></i>{{$rule->title}}
                                                                            </button>
                                                                        </h2>
                                                                    </div>
                                                                    <div id="collapse_{{$key}}" class="collapse {{$loop->first ? "show" : ''}}" aria-labelledby="headingNine"
                                                                        data-parent="#accordionExample4">
                                                                        <div class="card-body">
                                                                            <p>{{$rule->description}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @empty
                                                            @endforelse

                                                            {{--                                                    <div class="card">--}}
                                                            {{--                                                        <div class="card-header" id="heading11">--}}
                                                            {{--                                                            <h2 class="mb-0">--}}
                                                            {{--                                                                <button class="btn btn-link" type="button" data-toggle="collapse"--}}
                                                            {{--                                                                        data-target="#collapse11" aria-expanded="true" aria-controls="collapse11"><i--}}
                                                            {{--                                                                        class="fa fa-question"></i>How do I sign up to receive SMS winning alerts?--}}
                                                            {{--                                                                </button>--}}
                                                            {{--                                                            </h2>--}}
                                                            {{--                                                        </div>--}}
                                                            {{--                                                        <div id="collapse11" class="collapse show" aria-labelledby="heading11"--}}
                                                            {{--                                                             data-parent="#accordionExample4">--}}
                                                            {{--                                                            <div class="card-body">--}}
                                                            {{--                                                                <p>To subscribe to FREE SMS winning alerts, please fill in your mobile phone number in the 'SMS Number' field in the Notification settings and save the changes. To unsubscribe, please uncheck the box next to the 'SMS Number' field and save the changes.</p>--}}
                                                            {{--                                                            </div>--}}
                                                            {{--                                                        </div>--}}
                                                            {{--                                                    </div>--}}

                                                        </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="tab-content">
                                        <div class="tab-pane fade show active" id="pills-leaderboardr"
                                            role="tabpanel" aria-labelledby="pills-leaderboardr-tab">

                                            <div class="inner-table">
                                                <div class="responsive-table">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">USER</th>
                                                                <th scope="col">Place</th>
                                                                <th scope="col">Points</th>
                                                                <th scope="col">Prize</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <img src="assets/images/people/p1.png" alt="">
                                                                    Tom Bass
                                                                </td>
                                                                <td>
                                                                    01
                                                                </td>
                                                                <td>
                                                                    33528.36
                                                                </td>
                                                                <td>
                                                                    40 EUR X 30WR
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-more-info" role="tabpanel"
                                            aria-labelledby="pills-more-info-tab">
                                            <div class="info-content">
                                                <div class="info-box">
                                                    <h4 class="title">
                                                            Tournament Duration
                                                    </h4>
                                                    <p class="text">
                                                            7 Days (Monday 00:01 UTC - Sunday 23:59 UTC)
                                                    </p>
                                                </div>
                                                <div class="info-box two">
                                                    <h4 class="title">
                                                            Applicable Games
                                                    </h4>
                                                    <p class="text">
                                                            All Games Under 'Slots' Category
                                                    </p>
                                                </div>
                                                <div class="info-box three">
                                                    <h4 class="title">
                                                            Free Spin Reward Games

                                                    </h4>
                                                    <p class="text">
                                                            Book Of Pyramids, Brave Viking, Desert Treasure, Hawaii Cocktails, Lucky Blue, Lucky Lady Clover, Lucky Sweets,
                                                            Princess Of Sky, Princess Royal, Scroll Of Adventure, Slotomon Go, West Town Any Softswiss Slots Game | Wager x 40 times
                                                    </p>
                                                </div>
                                                <a href="#" class="mybtn1">Terms and Conditions</a>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <!--<div class="tab-pane fade" id="pills-vip-only" role="tabpanel"
                                aria-labelledby="pills-vip-only-tab">
                                <div class="inner-table-content">
                                        <div class="header-area">
                                            <ul class="nav" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-leaderboardr-vip-tab"
                                                        data-toggle="pill" href="#pills-leaderboardr-vip" role="tab"
                                                        aria-controls="pills-leaderboardr-vip"
                                                        aria-selected="true">Leaderboard</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-more-info-vip-tab" data-toggle="pill"
                                                        href="#pills-more-info-vip" role="tab"
                                                        aria-controls="pills-more-info-vip" aria-selected="false">More
                                                        Info</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-leaderboardr-vip"
                                                role="tabpanel" aria-labelledby="pills-leaderboardr-vip-tab">

                                                <div class="inner-table">
                                                    <div class="responsive-table">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">USER</th>
                                                                    <th scope="col">Place</th>
                                                                    <th scope="col">Points</th>
                                                                    <th scope="col">Prize</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/images/people/p1.png" alt="">
                                                                        Tom Bass
                                                                    </td>
                                                                    <td>
                                                                        01
                                                                    </td>
                                                                    <td>
                                                                        33528.36
                                                                    </td>
                                                                    <td>
                                                                        40 EUR X 30WR
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-more-info-vip" role="tabpanel"
                                                aria-labelledby="pills-more-info-vip-tab">
                                                <div class="info-content">
                                                    <div class="info-box">
                                                        <h4 class="title">
                                                                Tournament Duration
                                                        </h4>
                                                        <p class="text">
                                                                7 Days (Monday 00:01 UTC - Sunday 23:59 UTC)
                                                        </p>
                                                    </div>
                                                    <div class="info-box two">
                                                        <h4 class="title">
                                                                Applicable Games
                                                        </h4>
                                                        <p class="text">
                                                                All Games Under 'Slots' Category
                                                        </p>
                                                    </div>
                                                    <div class="info-box three">
                                                        <h4 class="title">
                                                                Free Spin Reward Games

                                                        </h4>
                                                        <p class="text">
                                                                Book Of Pyramids, Brave Viking, Desert Treasure, Hawaii Cocktails, Lucky Blue, Lucky Lady Clover, Lucky Sweets,
                                                                Princess Of Sky, Princess Royal, Scroll Of Adventure, Slotomon Go, West Town Any Softswiss Slots Game | Wager x 40 times
                                                        </p>
                                                    </div>
                                                    <a href="#" class="mybtn1">Terms and Conditions</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    <!-- Tournaments Area End -->
    @include('strip.tournament-payment',['id'=>$tournament->id])
    @include('modal.invite-modal',['id'=>$tournament->id])

@endsection

@push('js')
    <script src="{{asset("assets/js/bootstrap-datepicker.min.js")}}"></script>
    <script>
        $(".card-expiry-month").datepicker({
            format: "mm",
            startView: 1,
            minViewMode: 1,
            maxViewMode: 1
        });
        $(".card-expiry-year").datepicker({
            format: "yyyy",
            startView: 2,
            minViewMode: 2,
            maxViewMode: 3,
        });
        @if($tournament->type=='team')
        $(document).ready(function () {
            $('.matchBracket').bracket({
                init: {!! $brackets !!}
            });
        });
        @endif
    </script>
@endpush
