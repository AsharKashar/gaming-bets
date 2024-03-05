@extends('layout.indexlayout')

@section('content')


<!-- Slider Area Start -->
<section class="featured-games">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" style="">
            <div class="carousel-item active" style="">
                <img style="" class="cimg d-block w-100" src="assets/images/Content-coder/Call-of-duty-homepage2.jpg"
                    alt="First slide">
                <div class="carousel-caption ">
                    <img class="cbimg" src="assets/images/Content-coder/COD.png" alt="">
                    <p class="cbtext"> View the latest First Person Shooters.Set up your account, purchase our BombCoins
                        and start playing to win today!</p>
                </div>
            </div>
            <div class="carousel-item" style="">
                <img style="" class="cimg d-block w-100" src="assets/images/Content-coder/Fortnite-Homepage2.png"
                    alt="Second slide">
                <div class="carousel-caption ">
                    <img class="cbimg" src="assets/images/Content-coder/fortnite.png" alt="">
                    <p class="cbtext">View the latest First Person Shooters.Set up your account, purchase our BombCoins
                        and start playing to win today!</p>
                </div>
            </div>
            <div class="carousel-item" style="">
                <img style="" class="cimg d-block w-100" src="assets/images/Content-coder/Csgo-Homepage2.png"
                    alt="Third slide">
                <div class="carousel-caption ">
                    <img class="cbimg" src="assets/images/Content-coder/csgo.png" alt="">
                    <p class="cbtext"> View the latest First Person Shooters.Set up your account, purchase our BombCoins
                        and start playing to win today!</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span aria-hidden="true"> <img class="slider-icon" src="assets/images/Content-coder/back.png" alt=""></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span aria-hidden="true"><img class="slider-icon" src="assets/images/Content-coder/next.png" alt=""></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!--Slider area ends-->
<!--Feature games area starts-->
<section class="featured-game">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-10 col-sm-10">
                <div class="section-heading">
                    <h2 class="title">
                        Features Games
                    </h2>
                </div>
            </div>
        </div>
        <!--Featured cards carousel -->
        <div class="wrapper">
            <div class="carousel1">
                @foreach($games as $game) <div>
                    <div class="item">
                        <a href="{{route("game.tournaments",$game->id)}}"
                            onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                            <div class="single-game">
                                @if(strtoupper($game->name ) == "CALL OF DUTY")
                                <img href="{{route("game.tournaments",$game->id)}}" src="/storage/{{$game->image}}"
                                    onerror="this.onerror=null; this.src='assets/images/Content-coder/call-of-duty-card.png'"
                                    alt="">
                                @endif
                                @if(strtoupper($game->name ) == "FORTNITE")
                                <img href="{{route("game.tournaments",$game->id)}}" src="/storage/{{$game->image}}"
                                    onerror="this.onerror=null; this.src='assets/images/Content-coder/fortnite-card.png'"
                                    alt="">
                                @endif
                                @if(strtoupper($game->name ) == "CSGO")
                                <img href="{{route("game.tournaments",$game->id)}}" src="/storage/{{$game->image}}"
                                    onerror="this.onerror=null; this.src='assets/images/Content-coder/csgo-card.png'"
                                    alt="">
                                @endif
                                <div class="overlay">
                                    <h4 class="game-card-name" style="color: #E7E7E7;">{{$game->name}}</h4>
                                    <a href="{{route("game.tournaments",$game->id)}}"
                                        onerror="this.onerror=null; this.src='assets/images/game/icon2.png'"
                                        class="mybtn2">PLay</a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>@endforeach
                <div>
                    <div class="item">
                        <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                            <div class="single-game-extra">
                                <img href="" src=""
                                    onerror="this.onerror=null; this.src='assets/images/Content-coder/lol.png'" alt="">
                                <div class="overlay">
                                    <h4 class="game-card-name">League of legends</h4>
                                    <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'"
                                        class=""></a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="item">
                        <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                            <div class="single-game-extra" style="border:7px solid #a1afd3">
                                <img href="" src=""
                                    onerror="this.onerror=null; this.src='assets/images/Content-coder/lol.png'" alt="">
                                <div class="overlay">
                                    <h4 class="game-card-name">Coming soon</h4>
                                    <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'"
                                        class=""></a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--Featured cards carousel -->
    </div>
</section>
<!-- Featured Game Area	End -->

<!-- Cash Area Start -->
<div class="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-sm-10 d-flex align-self-center" style="">
                <div class="left-content">
                    <div class="content">
                        <h1 class="title">
                            Play for cash
                        </h1>
                        <h5 class="subtitle">
                            Your favourite games
                        </h5>
                        <p class="text">
                            Play the games you love on your favorite platforms for Cash and Clout. Join daily free and
                            pay-to-play games and tournaments for games like Apex Legends, Call of Duty, and Fortnite.
                        </p>
                        <div class="links">
                            <a href="{{route("game.tournaments",1)}}"
                                onerror="this.onerror=null; this.src='assets/images/game/icon2.png'"
                                class="indexbtn">play</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cash Area End -->
<!--Bomb and membership section starts-->
<section class="Bomb-membership">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <h4 class="bomb-heading">
                    Buy bombs & memberships
                </h4>
            </div>
            <div class="col-lg-6 col-sm-6">
                <h4 class="bomb-sub-heading">
                    In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the
                    visual form of a document or a typeface without relying on meaningful content.
                </h4>
            </div>
        </div>
        <div class="row buy-bomb-card">
            <div class="col-lg-6 col-sm-6">
                <div class="buy-cards">
                    <h4 class="buy-card-text">Bomb coins</h4>
                    <img class="bomb-img" src="assets/images/Content-coder/Larg-Group-2000px.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="buy-cards">
                    <h4 class="buy-card-text">Membership</h4>
                    <img class="bomb-img" src="assets/images/Content-coder/member-img.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!--Bomb and membership section ends-->
<!---latest new area starts-->
<section class="latest-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-8">
                <h4 class="news-heading">Our latest News</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <h4 class="news-heading2">Our latest new heading</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6  col-sm-6">
                <p class="news-p">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to
                    demonstrate the visual form of a document or a typeface without relying on meaningful content.</p>
            </div>
        </div>
        <div class="row" style="padding-top:35px">
            <div class="col-lg-3 col-sm-3"><a href="" class="indexbtn2">READ MORE</a></div>

            <div class="col-lg-3 col-sm-3"><a href="" class="indexbtn3">OTHER NEWS</a></div>
        </div>
    </div>
</section>
<!---latest new area ends-->
<!--top of month area--->
<section class="featured-game2">
    <section class="activities">
        <div class="funfact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 head-top-player-area">
                        <h2 class="top-title" style="">
                            Top of the month
                        </h2>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <p class="top-paragraf">In publishing and graphic design, Lorem ipsum is a placeholder text
                            commonly used to demonstrate the visual form of a document or a typeface without relying on
                            meaningful content.</p>
                    </div>

                    <div class="row top-card-row">

                        <div class="single-fun col-lg-4 col-sm-4">
                            <div class="top-player-card">
                                <img style="width:85%" src="assets/images/Content-coder/characters/pony.gif" alt="">
                                <div class="count-area">
                                    <div class="count">2nd</div>
                                </div>
                                <p>
                                    {{$ladder2&&$ladder2->user?$ladder2->user->name:'N/A'}}
                                </p>
                            </div>
                        </div>


                        <div class="single-fun col-lg-4 col-sm-4">
                            <div class="top-player-card">
                                <img style="width:85%" src="assets/images/Content-coder/characters/bow_1.gif" alt="">
                                <div class="count-area">
                                    <div class="count">1st</div>
                                </div>
                                <p>
                                    {{$ladder1&&$ladder1->user?$ladder1->user->name:'N/A'}}

                                </p>
                            </div>
                        </div>


                        <div class="single-fun col-lg-4 col-sm-4">
                            <div class="top-player-card">
                                <img style="width:85%" src="assets/images/Content-coder/characters/floss_1.gif" alt="">
                                <div class="count-area">
                                    <div class="count">3rd</div>
                                </div>
                                <p>
                                    {{$ladder3&&$ladder3->user?$ladder3->user->name:'N/A'}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--top of month area end--->
    <!--get game area starts-->
    <div class="container">
        <div class="row">
            <h4 class="page-timer">23:04:14</h4>
        </div>
        <div class="row">
            <h4 class="timer-tag"> <span class="space1">HRS</span><span class="space1">MIN</span><span
                    class="space1">SEC</span></h4>
        </div>
    </div>
    <div class="container index-timer">

        <ul>
            <li class="timer-inner" style=" "><span class="inner-span" id="days">:</span>days</li>
            <li class="timer-inner" style=" "><span class="inner-span" id="hours">:</span>Hours</li>
            <li class="timer-inner" style=" "><span class="inner-span" id="minutes">:</span>Minutes</li>
        </ul>
    </div>
    <section class="get-games">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <div class="circle-section text-center">
                        <img src="assets/images/Content-coder/red.png" alt="">
                        <h4 class="get-text">FREE GAMES</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 text-center">
                    <div class="circle-section text-center">
                        <img src="assets/images/Content-coder/blue.png" alt="">
                        <h4 class="get-text">GLOBAL LEADERBOARDS</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="circle-section text-center">
                        <img src="assets/images/Content-coder/green.png" alt="">
                        <h4 class="get-text">EASY FAST CASH PAYOUTS</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--get game area ends-->
    
    @endsection
