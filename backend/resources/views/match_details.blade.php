@extends('layout.mainlayout')

@push('css')
    <link rel="stylesheet" href="{{asset("assets/css/svgTimer.min.css")}}">
    <style>
        #timer {
            margin-top: 5rem;
        }
    </style>
@endpush

@section('content')

    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area bc-tournaments">
        <img class="bc-img" src="assets/images/breadcrumb/tournaments.png" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="title">
                        match details
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
                            <a href="/match_details">Match Details</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </section>



    <!-- Breadcrumb Area End -->
    <style>
        .title-up {
            color: #f9314b;
        }
    </style>
    <section class="play-games">
        <br><br><br>
        {{--        <br><br><br><br><br><br>--}}
        <div class="container">
            {{--    timer   --}}
            @if($match->start_at > now())

                <div class="row mb-5">
                    <div class="col-10 m-auto">
                        <div id="timer"></div>
                    </div>
                </div>

            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="gaming-activities" style="margin-top: 0">
                        <div class="gaming-activities-inner">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="single-activities mb-5">
                                        <div class="top-area">
                                            <div class="left col-lg-4">
                                                <img style="height: 200px !important;" src="/storage/{{$match->image}}" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'" alt="">
                                            </div>
                                            <div class="right col-lg-8">
                                                <h4 class="title">match details</h4>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="single-team">
                                                            <div class="social-area">
                                                                <h6 class="title-up">
                                                                    STATUS
                                                                </h6>
                                                                <p class="name">
                                                                    {{ strtoupper(str_replace("_","",$match->status))}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--                                                    <div class="col">--}}
                                                    {{--                                                        <div class="single-team">--}}
                                                    {{--                                                            <div class="social-area">--}}
                                                    {{--                                                                <h6 class="title-up">--}}
                                                    {{--                                                                    MATCH ID--}}
                                                    {{--                                                                </h6>--}}
                                                    {{--                                                                <p class="name">--}}
                                                    {{--                                                                    {{$match->match_id}}--}}
                                                    {{--                                                                </p>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                    <div class="col">
                                                        <div class="single-team ">
                                                            <div class="social-area">
                                                                <h6 class="title-up">
                                                                    MATCH TYPE
                                                                </h6>
                                                                <p class="name">
                                                                    {{$match->match_type}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="single-team">
                                                            <div class="social-area">
                                                                <h6 class="title-up">
                                                                    MATCH START
                                                                </h6>
                                                                <p class="name">
                                                                    {{$match->start_at->diffForHumans()}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="single-team ">
                                                            <div class="social-area">
                                                                <h6 class="title-up">
                                                                    MATCH EXPIRE
                                                                </h6>
                                                                <p class="name">
                                                                    {{$match->end_at->diffForHumans()}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="top-area">
                                            <div class="left">
                                                <!--<div class="icon">
                                                    <img src="assets/images/play/icon1.png" alt="">
                                                    <span>
                                                        4.5 <i class="fas fa-star"></i>
                                                    </span>
                                                </div>-->
                                            </div>
                                            <div class="right">
                                                <h4 class="title">match Rules</h4>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="single-team">
                                                            <div class="social-area">
                                                                <h6 class="title-up">
                                                                    HOST
                                                                </h6>
                                                                <p class="name">
                                                                    {{$match->hosted_by}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="single-team ">
                                                            <div class="social-area">
                                                                <h6 class="title-up">
                                                                    MATCH SET
                                                                </h6>
                                                                <p class="name">
                                                                    {{$match->match_type}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col">
                                                        <div class="single-team">
                                                            <div class="social-area">
                                                                <h6 class="title-up">
                                                                    GAME TYPE
                                                                </h6>
                                                                <p class="name">
                                                                    {{$match->game_type}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="top-area">
                                            <div class="left">
                                                <!--<div class="icon">
                                                    <img src="assets/images/play/icon1.png" alt="">
                                                    <span>
                                                        4.5 <i class="fas fa-star"></i>
                                                    </span>
                                                </div>-->
                                            </div>
                                            <div class="right">
                                                <h4 class="title">
                                                    match options
                                                </h4>
                                                <p class="text">
                                                    Platform: <span class="text-light">{{$match->platforms}}</span>
                                                </p>
                                                <p class="text">
                                                    Region: <span class="text-light">{{$match->regions}}</span>
                                                </p>
                                                <p class="text">
                                                    Game Mode: <span class="text-light">{{$match->game_mode}}</span>
                                                </p>
                                            </div>
                                        </div>

                                        {{--<div class="bottom-area">
                                            <h4 class="title">People Playing:</h4>
                                            <div class="players-count">
                                                <ul class="players-list">
                                                    <li>
                                                        <img src="assets/images/play/people.png" alt="">
                                                    </li>
                                                    <li>
                                                        <img src="assets/images/play/people.png" alt="">
                                                    </li>
                                                    <li>
                                                        <img src="assets/images/play/people.png" alt="">
                                                    </li>
                                                    <li>
                                                        <img src="assets/images/play/people.png" alt="">
                                                    </li>
                                                </ul>
                                                <div class="count-num">
                                                    40+
                                                </div>
                                            </div>
                                            <div class="pp">
                                                <p>50 People Playing</p>
                                            </div>
                                        </div>--}}
                                    </div>
                                    <!--<div class="col-lg-4 col-md-6">
                                        <div class="single-activities">
                                            <div class="top-area">
                                                <div class="left">
                                                    <div class="icon">
                                                        <img src="assets/images/play/icon2.png" alt="">
                                                        <span>
                                                            4.5 <i class="fas fa-star"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    <h4 class="title">
                                                        Crypto DICE
                                                    </h4>
                                                    <p class="text">
                                                        Roll the Dice
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bottom-area">
                                                <h4 class="title">People Playing:</h4>
                                                <div class="players-count">
                                                    <ul class="players-list">
                                                        <li>
                                                            <img src="assets/images/play/people.png" alt="">
                                                        </li>
                                                        <li>
                                                            <img src="assets/images/play/people.png" alt="">
                                                        </li>
                                                        <li>
                                                            <img src="assets/images/play/people.png" alt="">
                                                        </li>
                                                        <li>
                                                            <img src="assets/images/play/people.png" alt="">
                                                        </li>
                                                    </ul>
                                                    <div class="count-num">
                                                        40+
                                                    </div>
                                                </div>
                                                <div class="pp">
                                                    <p>50 People Playing</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-activities">
                                            <div class="top-area">
                                                <div class="left">
                                                    <div class="icon">
                                                        <img src="assets/images/play/icon3.png" alt="">
                                                        <span>
                                                            4.5 <i class="fas fa-star"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    <h4 class="title">
                                                        Crypto DICE
                                                    </h4>
                                                    <p class="text">
                                                        Roll the Dice
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bottom-area">
                                                <h4 class="title">People Playing:</h4>
                                                <div class="players-count">
                                                    <ul class="players-list">
                                                        <li>
                                                            <img src="assets/images/play/people.png" alt="">
                                                        </li>
                                                        <li>
                                                            <img src="assets/images/play/people.png" alt="">
                                                        </li>
                                                        <li>
                                                            <img src="assets/images/play/people.png" alt="">
                                                        </li>
                                                        <li>
                                                            <img src="assets/images/play/people.png" alt="">
                                                        </li>
                                                    </ul>
                                                    <div class="count-num">
                                                        40+
                                                    </div>
                                                </div>
                                                <div class="pp">
                                                    <p>50 People Playing</p>
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
            <style>
                .table td {
                    color: #eee;
                    border: 0;
                    border-bottom: 1px solid;
                    border-color: rgba(255,255,255,0.3);
                }
                .table thead {
                    position: sticky;
                }
                .table thead td {
                    font-weight: bold;
                    border-bottom: 2px solid;
                }
                #table-div {
                    height: 50vh;
                    overflow-y: scroll;
                }
            </style>
            <div class="row">
                <div class="col-lg-12">
                    <div class="gaming-activities" style="margin-top: 0">
                        <div class="gaming-activities-inner">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="single-activities mb-5" id="table-div">
                                        <table class="table" >
                                            <thead>
                                            <tr>
                                                <td>Player</td>
                                                <td>Position</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $row)
                                                <tr>
                                                    <td>{{$row->player_name}}</td>
                                                    <td>{{$row->position!='999999'?$row->position:'-'}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="all-games">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <ul class="nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-tab1-tab" data-toggle="pill" href="#pills-tab1" role="tab" aria-controls="pills-tab1" aria-selected="true">
                                    <div class="icon">
                                        <img class="one" src="assets/images/play/ic6.png" alt="">
                                        <img class="two" src="assets/images/play/ic66.png" alt="">
                                    </div>
                                    <span>Top Games</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab2-tab" data-toggle="pill" href="#pills-tab2" role="tab" aria-controls="pills-tab2" aria-selected="false">
                                <div class="icon">
                                    <img class="one" src="assets/images/play/ic1.png" alt="">
                                    <img class="two" src="assets/images/play/ic11.png" alt="">
                                </div>
                                <span>New</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab3-tab" data-toggle="pill" href="#pills-tab3" role="tab" aria-controls="pills-tab3" aria-selected="false">
                                <div class="icon">
                                    <img class="one" src="assets/images/play/ic2.png" alt="">
                                    <img class="two" src="assets/images/play/ic22.png" alt="">
                                </div>
                                <span>Slots</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab4-tab" data-toggle="pill" href="#pills-tab4" role="tab" aria-controls="pills-tab4" aria-selected="false">
                                <div class="icon">
                                    <img class="one" src="assets/images/play/ic3.png" alt="">
                                    <img class="two" src="assets/images/play/ic33.png" alt="">
                                </div>
                                <span>Jackpots</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab5-tab" data-toggle="pill" href="#pills-tab5" role="tab" aria-controls="pills-tab5" aria-selected="false">
                                <div class="icon">
                                    <img class="one" src="assets/images/play/ic4.png" alt="">
                                    <img class="two" src="assets/images/play/ic44.png" alt="">
                                </div>
                                <span>Video</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab6-tab" data-toggle="pill" href="#pills-tab6" role="tab" aria-controls="pills-tab6" aria-selected="false">
                                <div class="icon">
                                    <img class="one" src="assets/images/play/ic5.png" alt="">
                                    <img class="two" src="assets/images/play/ic55.png" alt="">
                                </div>
                                <span>Others</span>
                                </a>
                            </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="#" class="mybtn1">View More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-tab2" role="tabpanel" aria-labelledby="pills-tab2-tab">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="#" class="mybtn1">View More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-tab3" role="tabpanel" aria-labelledby="pills-tab3-tab">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="#" class="mybtn1">View More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-tab4" role="tabpanel" aria-labelledby="pills-tab4-tab">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="#" class="mybtn1">View More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-tab5" role="tabpanel" aria-labelledby="pills-tab5-tab">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="#" class="mybtn1">View More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-tab6" role="tabpanel" aria-labelledby="pills-tab6-tab">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon1.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon2.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-game">
                                            <img src="assets/images/game/icon3.png" alt="">
                                            <a href="#" class="mybtn2">PLay NoW !</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="#" class="mybtn1">View More</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
    </section>
    <!-- Play Games Area End -->
@endsection
@push("js")
    <script src="{{asset("assets/js/svgTimer.min.js")}}"></script>
    <script>
        @if($match->start_at > now())
        $('#timer').svgCountDown({
            date: '{{$match->start_at->format('Y-m-d h:i:s')}}'
        });
        @endif
    </script>

@endpush
