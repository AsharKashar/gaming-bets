@extends('layout.indexlayout')


@section('content')

    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area bc-tournaments">
        <div class="container-fluid tag" style="height: 70vh">
            @if(strtoupper($game->name ) == "CALL OF DUTY")
                <img class="tournament-banner-img" src="assets/images/Content-coder/Call-of-duty-tournaments2.jpg" alt="">
            @endif
            @if(strtoupper($game->name ) == "FORTNITE")
                <img class="tournament-banner-img" src="assets/images/Content-coder/Fortnite-Tournaments2.jpg" alt="">
            @endif
            @if(strtoupper($game->name ) == "CSGO")
                <img class="tournament-banner-img" src="assets/images/Content-coder/Csgo-Tournaments2.jpg" alt="">
            @endif
            <div class="middle">

                <div class="boxrow row">
                    <div class="col-lg-12">  @if(strtoupper($game->name ) == "CALL OF DUTY")
                            <img class="game-tournament-banner" src="assets/images/Content-coder/COD.png" alt=""> @endif
                        @if(strtoupper($game->name ) == "FORTNITE")
                            <img class="game-tournament-banner" src="assets/images/Content-coder/fortnite.png" alt=""> @endif
                        @if(strtoupper($game->name ) == "CSGO")
                            <img class="game-tournament-banner" src="assets/images/Content-coder/csgo.png" alt=""> @endif
                    </div>
                    <div class="boxcol2 col-lg-2">
                    </div>

                </div>
            </div>


        </div>


    </section>
    <!-- Breadcrumb Area End -->

    <!-- 404 Area Start -->
    <!-- 404 Area End -->
    <section class="game-details" style="padding: 0px 0px 0px;margin-left:-30px;margin-right:-30px;background-color:#010432">
        <div class="container">
            <div class="row" style="width:100%;height:30vh;background-color:#010432">
                <div class="col-lg-4 col-sm-4">
                    <h4 class="tournament-text" style="">{{$game->name}} Tournaments</h4>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <p class="game-tournament-description-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Featured Game Area Start -->
    <section class="featured-game">
        <!-- Features Area Start -->


        <!-- Features Area End -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">

                    </div>
                </div>
            </div>
            <div class="wrapper">

<div class="carousel2">
@if(strtoupper($game->name ) == "CALL OF DUTY")
<div>
                            <div class="item">
                                <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                                    <div class="single-game" id="bx">

                                        <img href="" src="assets/images/Content-coder/Fortnite_Boxfight-min.png" alt="">

                                        <div class="overlay">

                                            <h4 style="font-family:'Telegraf-UltraBold';color:#E7E7E7;font-size:28px;margin-top:85%;text-transform:uppercase"> Gun Fight</h4>
                                            <a href="#bx-role" style="cursor:pointer" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'" class="mybtn2">Join</a>
                                        </div>
                                    </div>
                                </a>
                            </div></div>
                        @endif
                        @if(strtoupper($game->name ) == "FORTNITE")
                         <div>   <div class="item">
                                <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                                    <div class="single-game" id="bx">

                                        <img href="" src="assets/images/Content-coder/Fortnite_Boxfight-min.png" alt="">

                                        <div class="overlay">

                                            <h4 style="font-family:'Telegraf-UltraBold';color:#E7E7E7;font-size:28px;margin-top:85%;text-transform:uppercase"> Box Fight</h4>
                                            <a href="#bx-role" style="cursor:pointer" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'" class="mybtn2">Join</a>
                                        </div>
                                    </div>
                                </a>
                            </div></div>
                        @endif
                       <div> <div class="item">
                            <a href="" onerror="this.onerror=null; this.src='assets/images/Content-coder/Fortnite_Battle Royale-min.png'">
                                <div class="single-game" id="bt">

                                    <img href="" src="assets/images/Content-coder/Fortnite_Battle Royale-min.png" alt="">

                                    <div class="overlay">
                                        @if(strtoupper($game->name ) == "FORTNITE")
                                            <h4 style="font-family:'Telegraf-UltraBold';color:#E7E7E7;font-size:28px;margin-top:85%;text-transform:uppercase"> Battle Royle</h4>
                                        @endif
                                        @if(strtoupper($game->name ) == "CALL OF DUTY")
                                            <h4 style="font-family:'Telegraf-UltraBold';color:#E7E7E7;font-size:28px;margin-top:85%;text-transform:uppercase"> Search and Destroy</h4>
                                        @endif
                                        @if(strtoupper($game->name ) == "CSGO")
                                            <h4 style="font-family:'Telegraf-UltraBold';color:#E7E7E7;font-size:28px;margin-top:85%;text-transform:uppercase"> Search and Destroy</h4>
                                        @endif
                                        <a href="#bt-role" style="cursor:pointer" onerror="this.onerror=null; this.src='assets/images/Content-coder/icon2.png'" class="mybtn2">Join</a>
                                    </div>
                                </div>
                            </a>
                        </div></div>


                       <div><div class="item">
                            <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                                <div class="single-game" style="border:none">
                                <img href="" src="assets/images/Content-coder/tournament-coming_soon.png" alt="">
                                <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:-20%;text-transform:uppercase">(Coming soon) </h4>
                                    <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:-25%;text-transform:uppercase">Race </h4>

                                    <div class="overlay1">

                                    </div>

                                </div>
                            </a>
                        </div></div>
                        <div><div class="item">
                            <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                                <div class="single-game" style="border:none">
                                <img href="" src="assets/images/Content-coder/tournament-coming_soon.png" alt="">
                                <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:-20%;text-transform:uppercase">(Coming soon) </h4>
                                    <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:-25%;text-transform:uppercase">Race </h4>

                                    <div class="overlay1">

                                    </div>

                                </div>
                            </a>
                        </div></div>
</div>
</div>
            <div class="row justify-content-center">

                <div class="col-lg-12 ml-md-auto">
                    <!--<div class="game-slider ">

                        @if(strtoupper($game->name ) == "CALL OF DUTY")
                            <div class="item">
                                <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                                    <div class="single-game" id="bx">

                                        <img href="" src="assets/images/Content-coder/Fortnite_Boxfight-min.png" alt="">
                                        <a style="cursor:pointer" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'" class="mybtn2">Join</a>
                                        <div class="overlay">

                                            <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:181px;text-transform:uppercase"> Gun Fight</h4>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if(strtoupper($game->name ) == "FORTNITE")
                            <div class="item">
                                <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                                    <div class="single-game" id="bx">

                                        <img href="" src="assets/images/Content-coder/Fortnite_Boxfight-min.png" alt="">
                                        <a style="cursor:pointer" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'" class="mybtn2">Join</a>
                                        <div class="overlay">

                                            <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:181px;text-transform:uppercase"> Box Fight</h4>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <div class="item">
                            <a href="" onerror="this.onerror=null; this.src='assets/images/Content-coder/Fortnite_Battle Royale-min.png'">
                                <div class="single-game" id="bt">

                                    <img href="" src="assets/images/Content-coder/Fortnite_Battle Royale-min.png" alt="">
                                    <a style="cursor:pointer" onerror="this.onerror=null; this.src='assets/images/Content-coder/icon2.png'" class="mybtn2">Join</a>
                                    <div class="overlay">
                                        @if(strtoupper($game->name ) == "FORTNITE")
                                            <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:181px;text-transform:uppercase"> Battle Royle</h4>
                                        @endif
                                        @if(strtoupper($game->name ) == "CALL OF DUTY")
                                            <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:181px;text-transform:uppercase"> Search and Destroy</h4>
                                        @endif
                                        @if(strtoupper($game->name ) == "CSGO")
                                            <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:181px;text-transform:uppercase"> Search and Destroy</h4>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="item">
                            <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                                <div class="single-game" style="border:3px solid #a1afd3">
                                    <h4 style="font-family:'Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:181px;text-transform:uppercase"> Coming soon</h4>
                                    <img href="" src="" alt="">
                                    <div class="overlay1">

                                    </div>

                                </div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'">
                                <div class="single-game" style="border:3px solid #a1afd3">
                                    <h4 style="font-family='Telegraf-UltraBold';color:#a1afd3;font-size:28px;margin-top:181px;text-transform:uppercase"> Coming soon</h4>
                                    <img href="" src="" alt="">
                                    <div class="overlay1">

                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>-->
                </div>


            </div>
        </div>
    </section>
    <!-- Featured Game Area	End -->


    <!-- Game Cards Start -->
    <section style="background: #010432;">
    <div class="container t-d" id="bt-role">

        <div class="row ar" style="">
            <div class="col-lg-3 col-sm-3">@if(strtoupper($game->name ) == "FORTNITE")
                    <h4 class="s1 ">Battle Royle</h4>@endif
                @if(strtoupper($game->name ) == "CALL OF DUTY")
                    <h4 class="s1 ">Search and Destroy</h4>@endif
                @if(strtoupper($game->name ) == "CSGO")
                    <h4 class="s1 ">Search and Destroy</h4>@endif
            </div>
            <div class="col-lg-3 col-sm-3">
                <ul class="navbar-nav1 s2">
                    <li class="nav-item active s2-1">
                        <a style="" id="tournament" class="nav-link s2-1-1">Tournament

                        </a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" href="#leader-info" id="leader">laddar</a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" href="#rule-details" id="rules">Rules

                        </a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" href="#overview-details" id="overview">overview

                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-sm-3">
                <ul class="navbar-nav1 s2" id="tournamentlist">


                    <li class="nav-item active s2-1">
                        <a style="" id="daily" class="nav-link s2-1-1" >Daily</a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" id="weekly">Weekly</a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" id="monthly">monthly</a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" id="">Icon</a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" id="">charity</a>

                    </li>

                </ul>
            </div>
            <div class="col-lg-2 col-sm-2">
            <ul class="navbar-nav1 s2" id="daily-filter-details">


                   <li class="nav-item active s2-1">
                       <a style="" id="daily-solo" class="nav-link s2-1-1" href="#daily-filter-solo">Solo</a>
                       <a style="margin-top:-20px" class="nav-link s2-1-1" id="daily-duo" href="#daily-filter-duo">Duo</a>
                       <a style="margin-top:-20px" class="nav-link s2-1-1" id="daily-squads" href="#daily-filter-squads">Squads</a>

                  </li>

              </ul>
              <ul class="navbar-nav1 s2" id="weekly-filter-details">


                   <li class="nav-item active s2-1">
                       <a style="" id="weekly-solo" class="nav-link s2-1-1" href="#weekly-filter-solo">Solo</a>
                       <a style="margin-top:-20px" class="nav-link s2-1-1" id="weekly-duo" href="#weekly-filter-duo">Duo</a>
                       <a style="margin-top:-20px" class="nav-link s2-1-1" id="weekly-squads" href="#weekly-filter-squads">Squads</a>

                  </li>

              </ul>
              <ul class="navbar-nav1 s2" id="monthly-filter-details">


                   <li class="nav-item active s2-1">
                       <a style="" id="monthly-solo" class="nav-link s2-1-1" href="#montly-filter-solo">Solo</a>
                       <a style="margin-top:-20px" class="nav-link s2-1-1" id="monthly-duo" href="#montly-filter-duo">Duo</a>
                       <a style="margin-top:-20px" class="nav-link s2-1-1" id="monthly-squads" href="#montly-filter-squads">Squads</a>

                  </li>

              </ul>
            </div>

</div>
    </div>
</section>
<section style="background:#010432">
    <div class="container t-d" id="bx-role">
        <div class="row ar" style="">
            <div class="col-lg-3"> @if(strtoupper($game->name ) == "FORTNITE")
                    <h4 class="s1">box fight</h4>@endif
                @if(strtoupper($game->name ) == "CALL OF DUTY")
                    <h4 class="s1">Gun Fight</h4>@endif
                @if(strtoupper($game->name ) == "CSGO")
                    <h4 class="s1">Gun Fight</h4>@endif
            </div>
            <div class="col-lg-4">
                <ul class="navbar-nav1 s2">
                    <li class="nav-item active s2-1">
                        <a style="" data-toggle="modal" data-target="#createfight" class="nav-link s2-1-1">Create Match

                        </a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" id="Join-fight">Join Match</a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" id="leader-x">Ladder

                        </a>
                        <a style="margin-top:-20px" class="nav-link s2-1-1" id="rules-x">Rules

                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 ">
                <ul class="navbar-nav1 s2" id="tournamentlist">


                    <li class="nav-item active s2-1">


                    </li>

                </ul>
            </div>
            <div class="col-lg 4" id="">
                <div class="row">
                    <div class="col-lg-4 s4">

                    </div>
                    <div class="col-lg-6 s5">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Game Cards End -->




    <div class="container-fluid detail-box" style="margin-top:-10px;height:auto" id="overview-details">

        <div class="container">
           <div class="row overview-section justify-content-end">
           <div class="col-lg-9 col-sm-9">
                      <p class="overview-text">
                            Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?
                       </p>
        </div>

           </div>
        </div>
    </div>
    <div class="container-fluid detail-box" style="margin-top:-10px;height:auto" id="rule-details">
        <div class="container">
        <div class="row rules-section">

<div class="col-lg-3 col-sm-3">
    <p class="rules-heading">
    Rule category name
    </p>
</div>
<div class="col-lg-9 col-sm-9">
    <p class="rules-text">
    Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?
    </p>
</div>

</div>
<div class="row rules-section">

<div class="col-lg-3 col-sm-3">
    <p class="rules-heading">
    Rule category name
    </p>
</div>
<div class="col-lg-9 col-sm-9">
    <p class="rules-text">
    Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?
    </p>
</div>

</div>
<div class="row rules-section">

<div class="col-lg-3 col-sm-3">
    <p class="rules-heading">
    Rule category name
    </p>
</div>
<div class="col-lg-9 col-sm-9">
    <p class="rules-text">
    Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?
    </p>
</div>

</div>
        </div>
    </div>
    <div class="container-fluid detail-box" style="margin-top:-10px;height:auto;" id="rule-x-details">
        <div class="container">
            <div class="row">

            <div class="row rules-section">

<div class="col-lg-3 col-sm-3">
    <p class="rules-heading">
    Rule category name
    </p>
</div>
<div class="col-lg-9 col-sm-9">
    <p class="rules-text">
    Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?
    </p>
</div>

</div>
<div class="row rules-section">

<div class="col-lg-3 col-sm-3">
    <p class="rules-heading">
    Rule category name
    </p>
</div>
<div class="col-lg-9 col-sm-9">
    <p class="rules-text">
    Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis arcilignimus maion rescit officip suntio conseque sitiiscit ea aut essin pratur?
    </p>
</div>

</div>
            </div>
        </div>
    </div>
    <div class="container-fluid detail-box" style="margin-top:-10px" id="leader-info" style="display:none">

        <div class="container detail-box">
            <div class="row">
                <div class="col-lg-8"></div>
                @auth
                <div class="col-lg-2 s4">
                    <h4 class="s4-1">Your Ranking</h4>
                </div>

                    <?php
                    $place = auth()->user()->place($game_id);
                    $winning = auth()->user()->points($game_id);
                    ?>
                <div class="col-lg-2 s5">
                    <h4 class="s5-1" style="margin-bottom: -21px;">place:
                        <span class="s5-1-1" style="color:#bf1438">{{$place ? $place : 'N/A'}}</span>
                    </h4>
                    <br>
                    <h4 class="s5-1" style="margin-bottom: -21px;">WL:
                        <span class="s5-1-1" style="color:#bf1438">{{$winning->point ? $winning->point : 'N/A'}}</span>
                    </h4>
                    <br>
                    <h4 class="s5-1" style="margin-bottom: -21px;">WR:
                        <span class="s5-1-1" style="color:#bf1438">{{$winning->winning ? $winning->winning : 'N/A'}}</span>
                    </h4>
                    <br>
                </div>
                @endauth
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="responsive-table">
                        <table class="table" style="color:#a1afd3">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">Place</th>
                                <th style="border-top:none" scope="col">Team</th>
                                <th style="border-top:none" scope="col">WL</th>
                                <th style="border-top:none" scope="col">WR</th>
                            </tr>
                            </thead>
                            <tbody>


                            {{--                            <tr style="bordor-bottom:3px solid #a1afd3">--}}
                            {{--                                <td>1</td>--}}
                            {{--                                <td>--}}

                            {{--                                    <a href="">xyz</a>--}}
                            {{--                                </td>--}}
                            {{--                                <td style="color:#bf1438">12.00</td>--}}
                            {{--                                <td style="color:#bf1438">340.00</td>--}}
                            {{--                            </tr>--}}
                            @foreach($ladder as $team)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>

                                        <a href="{{url('/profile_'.$team->user->id)}}">{{$team->user->name}}</a>
                                    </td>
                                    <td>{{$team->points}}</td>
                                    <td>{{$team->winning}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid detail-box" style="margin-top:-10px" id="leader-x-info" style="display:none">
        <div class="container details-box">
            <div class="row">
                <div class="col-lg-8"></div>
                <div class="col-lg-2 s4">
                    <h4 class="s4-1">Your Ranking</h4>
                </div>
                <div class="col-lg-2 s5">
                    <h4 class="s5-1" style="margin-bottom: -21px;">place:
                        <span class="s5-1-1" style="color:#bf1438">289</span>
                    </h4>
                    <br>
                    <h4 class="s5-1" style="margin-bottom: -21px;">WL:
                        <span class="s5-1-1" style="color:#bf1438">304.00</span>
                    </h4>
                    <br>
                    <h4 class="s5-1" style="margin-bottom: -21px;">WR:
                        <span class="s5-1-1" style="color:#bf1438">34.00</span>
                    </h4>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="responsive-table">
                        <table class="table" style="color:#a1afd3">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">Place</th>
                                <th style="border-top:none" scope="col">Team</th>
                                <th style="border-top:none" scope="col">WL</th>
                                <th style="border-top:none" scope="col">WR</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(strtoupper($game->name ) == "FORTNITE" && isset($ladder_1))
                                @foreach($ladder_1 as $record)
                                    @if($record->wins > 0)
                                        <tr style="bordor-bottom:3px solid #a1afd3">
                                            <td>
                                                <img src="assets/images/people/p1.png" alt="">
                                                {{$record->name}}
                                            </td>
                                            <td>
                                                To Be Sorted
                                            </td>
                                            <td style="color:#bf1438">
                                                {{$record->wins}}
                                            </td>
                                            <td style="color:#bf1438">
                                                {{$record->money}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                            @if(strtoupper($game->name ) == "CALL OF DUTY")
                                @foreach($ladder_2 as $record)
                                    @if($record->wins > 0)
                                        <tr style="bordor-bottom:3px solid #a1afd3">
                                            <td>
                                                <img src="assets/images/people/p1.png" alt="">
                                                {{$record->name}}
                                            </td>
                                            <td>
                                                To Be Sorted
                                            </td>
                                            <td style="color:#bf1438">
                                                {{$record->wins}}
                                            </td>
                                            <td style="color:#bf1438">
                                                {{$record->money}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Tournament Cards Start -->
    <!---daily tournament filter starts--->
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="daily-filter-solo">
        <div class="container detail-box-fixed">
            <div class="row">
                @foreach($daily as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="daily-filter-duo">
        <div class="container detail-box-fixed">
            <div class="row">
                @foreach($daily as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="daily-filter-squads">
        <div class="container detail-box-fixed">
            <div class="row">
                @foreach($daily as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <!---daily tournament filter ends--->
    <!---weekly tournament filter starts--->
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="weekly-filter-solo">
        <div class="container detail-box-fixed">
            <div class="row">
                @foreach($weekly as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="weekly-filter-duo">
        <div class="container detail-box-fixed">
            <div class="row">
                @foreach($weekly as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="weekly-filter-squads">
        <div class="container detail-box-fixed">
            <div class="row">
                @foreach($weekly as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <!---weekly tournament filter ends--->
    <!---monthly tournament filter starts--->
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="monthly-filter-solo">
        <div class="container detail-box-fixed">
            <div class="row">
                monthly solo
                @foreach($monthly as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="monthly-filter-duo">
        <div class="container detail-box-fixed">
            <div class="row">
                monthly duo
                @foreach($monthly as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <div class="container-fluid detail-box-fixed" style="margin-top:-10px" id="monthly-filter-squads">
        <div class="container detail-box-fixed">
            <div class="row">
                monthly squads
                @foreach($monthly as $tmt)
                    @include('tournament-sections.card',['tour'=>$tmt])
                @endforeach

            </div>
        </div>
    </div>
    <!---monthly tournament filter ends--->

    <div class="container-fluid detail-box" id="join-fight-list">
        <div class="container detail-box">
            <div class="row">
               <div class="col-lg-12">
               <div class="responsive-table">
                                                                    <table class="table" style="color:#a1afd3">
                                                                        <thead>
                                                                            <tr>
                                                                                <th  style="border-top:none">Match Type</th>
                                                                                <th  style="border-top:none">Platform</th>
                                                                                <th  style="border-top:none">Region</th>
                                                                                <th  style="border-top:none">Wager Amount</th>
                                                                                <th  style="border-top:none">Started Time</th>
                                                                                <th  style="border-top:none">Hosted By</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            <!--<tr>
                                                                                <td>2 vs 2</td>
                                                                                <td>Xbox</td>
                                                                                <td>NA East</td>
                                                                                <td>500(coin logo)</td>
                                                                                <td>Tue 16:00 CET</td>
                                                                                <td>Borja</td>
                                                                                <td><a style="margin-top: 0px" href="" class="mybtn1" data-toggle="modal" data-target="#join">Join</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2 vs 2</td>
                                                                                <td>Xbox</td>
                                                                                <td>NA East</td>
                                                                                <td>500(coin logo)</td>
                                                                                <td>Tue 16:00 CET</td>
                                                                                <td>Borja</td>
                                                                                <td><a style="margin-top: 0px" class="sign-in mybtn1" data-toggle="modal" data-target="#Wager1">Live</a>
                                                                                </td>
                                                                            </tr>-->


                                                                            @if(strtoupper($game->name ) == "FORTNITE")
                                                                            @foreach($data as $key => $value)
                                                                                    @if(($value->status==3 || $value->status==4) && $value->game_id==1)
                                                                                        <tr>
                                                                                            <td>
                                                                                                @if($value->game_type==1)
                                                                                                    1 vs 1
                                                                                                @endif

                                                                                                @if($value->game_type==2)
                                                                                                    2 vs 2
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>{{$value->platform}}</td>
                                                                                            <td>{{$value->region}}</td>
                                                                                            <td>{{$value->bid_amount}}</td>
                                                                                            <td>{{$value->time}}</td>
                                                                                            <td>{{$value->username}}</td>
                                                                                            <td>
                                                                                                @if(Auth::check())
                                                                                                    @if($value->status==3 && $value->result!='done' && $value->conflict_flag!=1)
                                                                                                        <a style="margin-top: 0px" onclick="endFight({{$value}})" class="sign-in mybtn1" data-toggle="modal" data-target="#Wager1">Live</a>
                                                                                                    @endif
                                                                                                    @if($value->conflict_flag!=1 && $value->result!='conflict' && $value->result!='done' && $value->status==4)
                                                                                                        <a style="margin-top: 0px" onclick="addresultpre({{$value}})" class="sign-in mybtn1" data-toggle="modal" data-target="#Wager2">Add Result</a>
                                                                                                    @endif
                                                                                                    @if($value->conflict_flag==1 && $value->result!='conflict' && $value->status==4)
                                                                                                        <a style="margin-top: 0px" onclick="uploadProofAction({{$value}})" class="sign-in mybtn1" >Upload Proof</a>
                                                                                                    @endif
                                                                                                    @if($value->conflict_flag==2 && $value->result!='conflict' && $value->status==4)
                                                                                                        Awaiting Admins Decision
                                                                                                    @endif
                                                                                                    @if($value->result=='done' && $value->conflict_flag!=1 && $value->status==4)
                                                                                                        Awaiting Remaining Users Response
                                                                                                    @endif
                                                                                                    @if($value->result=='conflict' && $value->conflict_flag==1 && $value->status==4)
                                                                                                        Proof Uploaded
                                                                                                    @endif
                                                                                                @endif
                                                                                                @if(!(Auth::check()))
                                                                                                Please Login to join
                                                                                                @endif


                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif

                                                                            @endforeach

                                                                            @foreach($data as $key => $value)
                                                                                    @if(($value->status==1 || $value->status==2) && $value->game_id==1)
                                                                                        <tr>
                                                                                            <td>
                                                                                                @if($value->game_type==1)
                                                                                                    1 vs 1
                                                                                                @endif

                                                                                                @if($value->game_type==2)
                                                                                                    2 vs 2
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>{{$value->platform}}</td>
                                                                                            <td>{{$value->region}}</td>
                                                                                            <td>{{$value->bid_amount}}</td>
                                                                                            <td>{{$value->time}}</td>
                                                                                            <td>{{$value->username}}</td>
                                                                                            <td>
                                                                                                @if(Auth::check())

                                                                                                    @if($value->status==1 && $value->result!='done' && $value->result!='joined')
                                                                                                        <a style="margin-top: 0px" onclick="selectFight({{$value}})" href="" class="mybtn1" data-toggle="modal" data-target="#join">Join</a>
                                                                                                    @endif
                                                                                                    @if($value->status==2 && $value->result!='done' && $value->result!='joined')
                                                                                                        Match Full
                                                                                                    @endif
                                                                                                    @if($value->result=='done')
                                                                                                        Awaiting Remaining Users Response
                                                                                                    @endif
                                                                                                    @if($value->result=='joined')
                                                                                                        Joined
                                                                                                    @endif
                                                                                                @endif
                                                                                                @if(!(Auth::check()))
                                                                                                Please Login to join
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif

                                                                            @endforeach


                                                                        @if(Auth::check())
                                                                            @foreach($canel as $key => $value)
                                                                                @if($value->status==6 && $value->game_id==1)
                                                                                    <tr>
                                                                                        <td>
                                                                                            @if($value->game_type==1)
                                                                                                1 vs 1
                                                                                            @endif

                                                                                            @if($value->game_type==2)
                                                                                                2 vs 2
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>{{$value->platform}}</td>
                                                                                        <td>{{$value->region}}</td>
                                                                                        <td>{{$value->bid_amount}}</td>
                                                                                        <td>{{$value->time}}</td>
                                                                                        <td>{{$value->username}}</td>
                                                                                        <td>

                                                                                            @if($value->status==6)
                                                                                                Match Cancelled
                                                                                            @endif




                                                                                        </td>
                                                                                    </tr>
                                                                                @endif

                                                                            @endforeach
                                                                        @endif









                                                                        @endif




                                                                    @if(strtoupper($game->name ) == "CALL OF DUTY")
                                                                    @foreach($data as $key => $value)
                                                                    @if(($value->status==3 || $value->status==4) && $value->game_id==2)
                                                                        <tr>
                                                                            <td>
                                                                                @if($value->game_type==1)
                                                                                    1 vs 1
                                                                                @endif

                                                                                @if($value->game_type==2)
                                                                                    2 vs 2
                                                                                @endif
                                                                            </td>
                                                                            <td>{{$value->platform}}</td>
                                                                            <td>{{$value->region}}</td>
                                                                            <td>{{$value->bid_amount}}</td>
                                                                            <td>{{$value->time}}</td>
                                                                            <td>{{$value->username}}</td>
                                                                            <td>
                                                                                @if(Auth::check())
                                                                                    @if($value->status==3 && $value->result!='done' && $value->conflict_flag!=1)
                                                                                        <a style="margin-top: 0px" onclick="endFight({{$value}})" class="sign-in mybtn1" data-toggle="modal" data-target="#Wager1">Live</a>
                                                                                    @endif
                                                                                    @if($value->conflict_flag!=1 && $value->result!='conflict' && $value->result!='done' && $value->status==4)
                                                                                        <a style="margin-top: 0px" onclick="addresultpre({{$value}})" class="sign-in mybtn1" data-toggle="modal" data-target="#Wager2">Add Result</a>
                                                                                    @endif
                                                                                    @if($value->conflict_flag==1 && $value->result!='conflict' && $value->status==4)
                                                                                        <a style="margin-top: 0px" onclick="uploadProofAction({{$value}})" class="sign-in mybtn1" >Upload Proof</a>
                                                                                    @endif
                                                                                    @if($value->conflict_flag==2 && $value->result!='conflict' && $value->status==4)
                                                                                        Awaiting Admins Decision
                                                                                    @endif
                                                                                    @if($value->result=='done' && $value->conflict_flag!=1 && $value->status==4)
                                                                                        Awaiting Remaining Users Response
                                                                                    @endif
                                                                                    @if($value->result=='conflict' && $value->conflict_flag==1 && $value->status==4)
                                                                                        Proof Uploaded
                                                                                    @endif
                                                                                @endif
                                                                                @if(!(Auth::check()))
                                                                                Please Login to join
                                                                                @endif


                                                                            </td>
                                                                        </tr>
                                                                    @endif

                                                            @endforeach

                                                            @foreach($data as $key => $value)
                                                                    @if(($value->status==1 || $value->status==2) && $value->game_id==1)
                                                                        <tr>
                                                                            <td>
                                                                                @if($value->game_type==1)
                                                                                    1 vs 1
                                                                                @endif

                                                                                @if($value->game_type==2)
                                                                                    2 vs 2
                                                                                @endif
                                                                            </td>
                                                                            <td>{{$value->platform}}</td>
                                                                            <td>{{$value->region}}</td>
                                                                            <td>{{$value->bid_amount}}</td>
                                                                            <td>{{$value->time}}</td>
                                                                            <td>{{$value->username}}</td>
                                                                            <td>
                                                                                @if(Auth::check())

                                                                                    @if($value->status==1 && $value->result!='done' && $value->result!='joined')
                                                                                        <a style="margin-top: 0px" onclick="selectFight({{$value}})" href="" class="mybtn1" data-toggle="modal" data-target="#join">Join</a>
                                                                                    @endif
                                                                                    @if($value->status==2 && $value->result!='done' && $value->result!='joined')
                                                                                        Match Full
                                                                                    @endif
                                                                                    @if($value->result=='done')
                                                                                        Awaiting Remaining Users Response
                                                                                    @endif
                                                                                    @if($value->result=='joined')
                                                                                        Joined
                                                                                    @endif
                                                                                @endif
                                                                                @if(!(Auth::check()))
                                                                                Please Login to join
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endif

                                                            @endforeach


                                                        @if(Auth::check())
                                                            @foreach($canel as $key => $value)
                                                                @if($value->status==6 && $value->game_id==1)
                                                                    <tr>
                                                                        <td>
                                                                            @if($value->game_type==1)
                                                                                1 vs 1
                                                                            @endif

                                                                            @if($value->game_type==2)
                                                                                2 vs 2
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$value->platform}}</td>
                                                                        <td>{{$value->region}}</td>
                                                                        <td>{{$value->bid_amount}}</td>
                                                                        <td>{{$value->time}}</td>
                                                                        <td>{{$value->username}}</td>
                                                                        <td>

                                                                            @if($value->status==6)
                                                                                Match Cancelled
                                                                            @endif




                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                            @endforeach
                                                        @endif


                                                                    @endif




                                                                            </tbody>
                                                                    </table>
                                                                </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Tournament Cards End -->




    @foreach($all as $tmt)
        @if(strtoupper($game->name ) == "FORTNITE")
            @include('tournament-sections.options',['tour'=>$tmt])
        @else
            @include('tournament-sections.optionsx',['tour'=>$tmt])
        @endif
    @endforeach

    @include('modal.upload-evidence')

    <!-- Recent Winners Area Start -->
    <!--<section class="recent-winners">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-heading">
                        <h5 class="subtitle">
                            Try to Check out our
                        </h5>
                        <h2 class="title">
                            Recent Winners
                        </h2>
                        <p class="text">
                            We update our site regularly; more and more winners are added every day! To locate the most
                            recent winner's information
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-winer">
                        <div class="top-area">
                            <div class="left">
                                <h4 class="name">
                                    Leroy Roy
                                </h4>
                                <p class="date">
                                    01.08.2019
                                </p>
                            </div>
                            <div class="right">
                                <p class="id">#5747e75482</p>
                            </div>
                        </div>
                        <div class="bottom-area">
                            <div class="left">
                                0.099 ETH
                            </div>
                            <div class="right">
                                <img src="assets/images/icon2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-winer">
                        <div class="top-area">
                            <div class="left">
                                <h4 class="name">
                                    Jeff Mack
                                </h4>
                                <p class="date">
                                    01.08.2019
                                </p>
                            </div>
                            <div class="right">
                                <p class="id">#5747e75482</p>
                            </div>
                        </div>
                        <div class="bottom-area">
                            <div class="left">
                                0.099 ETH
                            </div>
                            <div class="right">
                                <img src="assets/images/icon2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-winer">
                        <div class="top-area">
                            <div class="left">
                                <h4 class="name">
                                    Neal Morris
                                </h4>
                                <p class="date">
                                    01.08.2019
                                </p>
                            </div>
                            <div class="right">
                                <p class="id">#5747e75482</p>
                            </div>
                        </div>
                        <div class="bottom-area">
                            <div class="left">
                                0.099 ETH
                            </div>
                            <div class="right">
                                <img src="assets/images/icon2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-xl-center">
                    <a class="mybtn2" href="#">View All </a>
                </div>
            </div>
        </div>
    </section>-->
    <!-- create box fight Area Start -->
<div class="modal fade createfight sign-in" id="createfight" tabindex="-1" role="dialog" aria-labelledby="createfight" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                <div class="row">
                <div class="col-lg-5"><h4 class="title wager-title" style="font-size:24px;color:#bf1438;">Create Fight</h4></div>
                <div class="col-lg-7"><p class="sub-title wager-details" style="font-size:20px;margin-top:26px;line-height:94%;width:335px;margin:44px 44px 44px 44px">Fill this form to create you own fight.</p></div>
</div>


                </div>
                <div class="form-area">
                    <form class="createClass" id="cpa_form">


                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="input-name">Platform</label>
                            <select class="platform">
                                <option value="Cross-Platform">Cross-Platform</option>
                                <option value="Xbox">Xbox</option>
                                <option value="Playstation" >Playstation</option>
                                <option value="PC" >PC</option>


                            </select>
                        </div>
                            </div>
                            <div class="col-md-6">


                        <div class="form-group">
                            <label for="input-email">Region</label>
                            <select class="region">
                                <option value="Europe">Europe</option>
                                <option value="NA East" >NA East</option>
                                <option value="NA West" >NA West</option>
                                <option value="Oceania" >Oceania</option>
                                <option value="Brazil" >Brazil</option>

                            </select>
                        </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="input-email">Date</label>
                            <input type="date" id="start" name="trip-start"
                            value="" class="date_start input-field" id="input-date"  placeholder="Enter Date" value="" required>
                        </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="input-email">Time</label>
                            <input type="time" class="time_start input-field" id="input-email" name="email" placeholder="Enter Time" required>
                        </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="input-email">Your Bid</label>
                            <input type="text" class="bid input-field" id="input-email" name="email" placeholder="Enter Your Bid" value="" required>
                        </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="input-email">Epic username</label>
                            <input type="text" class="username input-field" id="input-email" name="email" placeholder="Enter Epic username" value="" required>
                        </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">

                                <div>
                                    <h3 style="font-family:'Telegraf-Regular';font-size:26px;color:#a1afd3">Match Type</h3>
                                    <label>
                                      <input style="margin-top: 5px" type="radio" class="radio" value="1" name="fooby[1][]" />  1 VS 1</label>
                                  </div>
                            </div>
                            <div class="col-md-6">

                                <label>
                                    <input style="margin-top: 45px"  type="radio" class="radio" value="2" name="fooby[1][]" />  2 VS 2</label>
                                </div>
                        </div>



{{--                        <div class="form-group">--}}
{{--                            <select>--}}
{{--                                <option value="0">BTC</option>--}}
{{--                                <option value="1">USD</option>--}}
{{--                                <option value="2">EUR</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <div class="check-group">
                                <input type="checkbox" class="check-box-field" name="terms" id="input-terms" checked required>
                                <label for="input-terms">
                                    I agree with <a href="/terms-conditions">terms and Conditions</a> and  <a href="/terms-conditions-details">privacy policy</a>
                                </label>
                            </div>
                        </div>
                        <!--
                            <div class="startBut form-group">
                                <button data-toggle="modal"
                                data-target="#sharelink"
                                data-dismiss="modal" type="submit" class="mybtn1">Start</button>
                            </div>-->
                            <div class="alert alert-danger" id="limaError" style="display: none" role="alert">
                                Not enough Bomb in your account
                            </div>
                            <div class="alert alert-danger" id="limaErrorOut" style="display: none" role="alert">
                                You are out of box fights for this month, Please buy membership, or come back next month.
                            </div>
                            <div class="alert alert-danger" id="alreadyMatch" style="display: none" role="alert">
                                You already have a live match at the starting time of this match.
                            </div>
                            <div class="alert alert-danger" id="alreadyMatchLive" style="display: none" role="alert">
                                You are already a part of live match.
                            </div>

                            <div class="startBut form-group">
                                <button

                                 type="submit" class="mybtn1">Start</button>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- create fight Area End -->
    <!-- Recent Winners Area End -->

    <div class="modal fade joinfight" id="wager3" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" onclick="uploadProofActionClose()" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <!--<div class="logo-area">
                            <img class="logo" src="assets/images/logo.png" alt="">
                    </div>-->
                    <!--<div class="col-lg-6" style="margin-top: 20px">Disputed<i style="margin-left: 10px;color:#c2c2c4" class="fas fa-circle"></i></div>-->
                    <div class="row" style="height:100px">
                        <div class="col-lg-6">
                            <h4 class="title wager-title" style="">Current wager</h4>
                        </div>
                        <div class="col-lg-6">
                            <p id="gametype" class="sub-title"></p>
                            <p class="sub-title wager-details" style="margin-top:26px;line-height: 20px;width: 225px;margin-left:-20px">There has been a dispute. Please provide evidence of the final match results. the evidence will be reviewed within 2 hours and the true winner will be rewarded.</p>

                        </div>
                    </div>
                    <div class="header-area">
                        <div class="row text-center" style="height: 100px">
                            <h4 class="dispute-text">DISTPUTE</h4>
                            <!--<div class="col-lg-4">
                                <h4 class="title1"></h4>
                                <h4 class="title2"></h4>
                            </div>
                            <div class="col-lg-4"><img class="" style="width: 75%;margin-top:-25px" src="/assets/images/Group1.svg" alt="" ></div>
                            <div class="col-lg-4">
                                <h4 class="title3"></h4>
                                <h4 class="title4"></h4>
                            </div>-->
                        </div>
                        <!-- <div class="row">
                             <div class="col-lg-12">
                             <div class="row">
                                 <div class="col-lg-4" style="border-right: 1px solid #dfdfdf;border-top: 1px solid #dfdfdf;border-left: 1px solid #dfdfdf;
                                 border-bottom: 1px solid #dfdfdf;padding-top:10px"><p class="gametype"></p></div>
                                 <div class="col-lg-4"style="border-right: 1px solid #dfdfdf;border-top: 1px solid #dfdfdf;
                                 border-bottom: 1px solid #dfdfdf;"><p class="time"></p></div>
                                 <div class="col-lg-4"style="border-right: 1px solid #dfdfdf;border-top: 1px solid #dfdfdf;
                                 border-bottom: 1px solid #dfdfdf;padding-top:10px"><p class="region"></p></div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-4"style="border-right: 1px solid #dfdfdf;border-left: 1px solid #dfdfdf;
                                 border-bottom: 1px solid #dfdfdf;height:50px;padding-top:10px"><p class="platform"></p></div>
                                 <div class="col-lg-4"style="border-right: 1px solid #dfdfdf;
                                 border-bottom: 1px solid #dfdfdf;padding-top:10px"><p class="bidamount"></p></div>
                                 <div class="col-lg-4"style="border-right: 1px solid #dfdfdf;
                                 border-bottom: 1px solid #dfdfdf;padding-top:10px"></div>
                             </div>
                         </div>-->

                    </div>


                </div>

                <!-- ///////////////////////////////////////////////////// Dispute div for box gaming //////////////////////////////////-->
                <div class="form-area">
                    <form action="#" method="POST">
                        <div>
                            <div class="form-group">
                                <!-- <center>  <h4 class="title">Disputed!!</h4></center>-->
                            </div>

                    </form>
                </div>
                <!--<center>   <p class="sub-title">Please upload photo & video evidence of the final match results. The evidence will be reviewed within 2 hours and the true winner will be rewarded</p></center>-->


                        <div class="row">
                            <div class="col-lg-3" style="margin-left:44px">Live<i style="margin-left: 10px;color:red" class="fas fa-circle"></i>
                            </div>
                            <div class="col-lg-3">review details</div>
                            <div class="col-lg-6">
                                <input type="file" onchange="pictureUpload()" style="display:inline-block" id="files" ref="files">
                            </div>

                            <div class="col-lg-3">
                                Evidence Number 1 (photo)
                                {{-- <button type="" onclick="submitFiles()" class="wagerbtn" style="line-height:25px">Photo Upload</button> --}}
                            </div><br>

                            {{-- <div class="col-lg-3">review details</div> --}}
                            <div class="col-lg-6">
                                <input type="file" onchange="pictureUpload1()" style="display:inline-block" id="files1" ref="files1">
                            </div>

                            <div class="col-lg-3">
                                Evidence Number 2 (video)
                                {{-- <button type="" onclick="submitFiles()" class="wagerbtn" style="line-height:25px">Video Upload</button> --}}
                            </div><br>
                            <div class="alert alert-danger" id="evidenceTimeOut" style="display: none" role="alert">
                                No longer accepting evidence
                            </div>
                            <br>
                            {{-- <div class="col-lg-3"><br> --}}
                                <center><button id="upload_button_pre" type="" onclick="submitFiles()" class="wagerbtn" style="line-height:25px;margin-left:12vw">Upload Evidence</button></center>
                                <center><button id="upload_button_post" type="" class="wagerbtn" style="line-height:25px;margin-left:12vw;display:none" disabled>Uploading....</button></center>
                            {{-- </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!---Report issue area starts-->
<div class="modal fade createfight sign-in" id="report-issue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                <div class="col-lg-6"><h4 class="title wager-title" style="">Report issue</h4></div>
                <div class="col-lg-6"><p class="sub-title wager-details" style="font-size:12px;margin-top:26px;line-height: 20px;width: 225px;margin-left:-20px">Please fill the form and we will reply to you as soon as possible within our working days.</p></div>
                </div>
                <div class="form-area">
                    <form class="createClass" id="cpa_form1" action="{{route('user.report_issue')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="height:44px;margin-bottom:0px">
                            <label for="input-name" style="width:50%">Subject title</label>
                            <input style="width:48%" type="text" name="title" class="input-field" id="input-email"  placeholder="Enter here your title" required>
                        </div>
                        <hr>
                        <div class="form-group" style="height:44px;margin-bottom:0px">
                            <label for="input-email" style="width:50%">E-mail*</label>
                            <input style="width:48%" type="email" name="email" class="input-field" id="input-email"  placeholder="example@gmail.com" required>
                        </div>
                        <hr>
                        <div class="form-group" style="height:44px;margin-bottom:0px">
                            <label for="input-password" style="width:50%">Description</label>
                            <input style="width:48%" type="text" name="description" class="input-field" id="input-email"  placeholder="Write here your issue" required>
                        </div>
                        <hr>
                            <div class="startBut form-group" style="margin-top:80px">
                            <div class="row">
                                <div class="col-lg-6"><label style="color:#bf1438;font-family:'Telegraf-Regular';;cursor:pointer">Upload files
                                              <input type="file" size="60" name="file" >
                                               </label>
                                  </div>
                                <div class="col-lg-6"><button style="margin-left: 22px; margin-bottom: 10px;" type="submit" class="wagerbtn">Send</button></div>
                            </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <!---Report issue area ends-->
@endsection

@push('js')
    <script>
    var refreshlink;
    var dets={};
    var uploadedFiles;
    var uploadedFiles1;
    var upload_counter=0;
    var complete_counter=0;
    var upload_flag_1=false;
    var upload_flag_2=false;
        // function joiningFun(key){
        //         console.log(key);
        //     }
        // jQuery(document).ready(function () {

        // //   function joinFunction(key){
        //     console.log("key");
        // //     }
        // )};/
        function refreshpage() {
            if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
            {location.reload();}
            else{
                window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role';
            }
            //window.location.href = window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role';
             //window.location.href = '/tournaments-1?status=true#bt-role';
        }
        var endfight_variable;
        function endFight(key) {
            $('.title1').text("");
            $('.title2').text("");
            $('.title3').text("");
            $('.title4').text("");
            this.endMatchid = key.match_id;
            endfight_variable=key.match_id;
            //console.log(key);
            if (key.game_type == 2) {
                $('#gametype').text("2 V 2");
                $('.gametype').text("2 V 2");
            } else if (key.game_type == 1) {
                $('#gametype').text("1 V 1");
                $('.gametype').text("1 V 1");
            }
            $('#platform').text("Platform: " + key.platform);
            $('.platform').text("Platform: " + key.platform);
            $('#region').text("Region: " + key.region);
            $('.region').text("Region: " + key.region);
            $('#time').text("Time: " + key.time);
            $('.time').text("Time: " + key.time);
            $('#bid').text("Amount: " + key.bid_amount);
            $('.bidamount').text("Amount: " + key.bid_amount);


            $.ajax({
                url: '/api/viewBoxFightTeam/' + key.match_id,
                type: 'GET',

                //data: details,
                success: function (data) {
                    console.log(data);
                    if (data[0].game_type == 1) {
                        $('.title1').text(data[0].username);
                        $('.title2').text("");
                        $('.title3').text(data[1][0].username);
                        $('.title4').text("");
                    } else {
                        $('.title1').text(data[0].username);
                        $('.title2').text(data[1].username);
                        $('.title3').text(data[2][0].username);
                        $('.title4').text(data[2][1].username);
                    }

                },
                error: function (request, status, error) {

                    console.log(request.responseText)
                }
            });
        }

        function addresultpre(key){
            $('.title1').text("");
            $('.title2').text("");
            $('.title3').text("");
            $('.title4').text("");
            this.endMatchid = key.match_id;
            endfight_variable=key.match_id;
            //console.log(key);
            if (key.game_type == 2) {
                $('#gametype').text("2 V 2");
                $('.gametype').text("2 V 2");
            } else if (key.game_type == 1) {
                $('#gametype').text("1 V 1");
                $('.gametype').text("1 V 1");
            }
            $('#platform').text("Platform: " + key.platform);
            $('.platform').text("Platform: " + key.platform);
            $('#region').text("Region: " + key.region);
            $('.region').text("Region: " + key.region);
            $('#time').text("Time: " + key.time);
            $('.time').text("Time: " + key.time);
            $('#bid').text("Amount: " + key.bid_amount);
            $('.bidamount').text("Amount: " + key.bid_amount);


            $.ajax({
                url: '/api/viewBoxFightTeam/' + key.match_id,
                type: 'GET',

                //data: details,
                success: function (data) {
                    console.log(data);
                    if (data[0].game_type == 1) {
                        $('.title1').text(data[0].username);
                        $('.title2').text("");
                        $('.title3').text(data[1][0].username);
                        $('.title4').text("");
                    } else {
                        $('.title1').text(data[0].username);
                        $('.title2').text(data[1].username);
                        $('.title3').text(data[2][0].username);
                        $('.title4').text(data[2][1].username);
                    }

                },
                error: function (request, status, error) {

                    console.log(request.responseText)
                }
            });
        }

        function addresultpost(){
            $.ajax({
                url: '/api/endLiveMatch/' + endfight_variable,
                type: 'GET',

                //data: details,
                success: function (data) {
                    if (data=='statusError')
                    {
                        $("#liveTimeOut").css("display", "block");
                        setTimeout(() => $("#liveTimeOut").css("display", "none"), 3000);
                        if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {
                            setTimeout(() =>  location.reload(), 3000);
                            }
                        else
                        {
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 3000);
                            }
                    }
                    else
                    {
                        if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {
                            setTimeout(() =>  location.reload(), 1000);
                            }
                        else
                        {
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 1000);
                            }
                    }
                 },
                error: function (request, status, error) {

                    console.log(request.responseText)
                }
            });
        }


        function selectFight(key) {
            console.log('h'+key)
            this.selectedMatch = key.match_id;
            $("#UserExistsMsg").css("display", "none");
            console.log(this.selectedMatch);
//AJAX CALL WILL BE MADE HERE for match details
            if (key.game_type == 2) {
                $('#gametype1').text("Game Type: 2 V 2");
            } else if (key.game_type == 1) {
                $('#gametype1').text("Game Type: 1 V 1");
            }
            $('#platform1').text("Platform: " + key.platform);
            $('#region1').text("Region: " + key.region);
            $('#time1').text("Time: " + key.time);
            $('#host1').text("Host: " + key.username);
            $('#bid1').text("Amount: " + key.bid_amount);


        }


        function changetoYes() {
            @if(Auth::check())
                dets['user_id'] = "<?php echo auth()->user()->id; ?>";
            @endif
                dets['status'] = 'won';
            var team_id = this.endMatchid;
            @if(strtoupper($game->name ) == "FORTNITE")
                dets['box_game_id'] = 1;
            @endif

                @if(strtoupper($game->name ) == "CALL OF DUTY")
                dets['box_game_id'] = 2;
            @endif

            $.ajax({
                url: '/api/statusChange/' + team_id,
                type: 'POST',

                data: dets,
                success: function (data) {
                    if (data=='statusError')
                    {
                        $("#resultTimeOut").css("display", "block");
                        setTimeout(() => $("#resultTimeOut").css("display", "none"), 3000);
                        if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {
                            setTimeout(() =>  location.reload(), 3000);
                            }
                        else
                        {
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 3000);
                            }
                    }


                    else
                    {
                        if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {
                            setTimeout(() =>  location.reload(), 1000);
                        }
                        else
                        {
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 1000);
                        }
                    }

                },
                error: function (request, status, error) {

                    console.log(request.responseText)
                }
            });
        }

        function changetoNo() {
            @if(Auth::check())
                dets['user_id'] = "<?php echo auth()->user()->id; ?>";
            @endif
                dets['status'] = 'lost';
            var team_id = this.endMatchid;
            $.ajax({
                url: '/api/statusChange/' + team_id,
                type: 'POST',

                data: dets,
                success: function (data) {
                    if (data=='statusError')
                    {
                        $("#resultTimeOut").css("display", "block");
                        setTimeout(() => $("#resultTimeOut").css("display", "none"), 3000);
                        if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {
                            setTimeout(() =>  location.reload(), 3000);
                            }
                        else
                        {
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 3000);
                            }
                    }


                    else
                    {
                        if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {
                            setTimeout(() =>  location.reload(), 1000);
                        }
                        else
                        {
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 1000);
                        }
                    }


                },
                error: function (request, status, error) {

                    console.log(request.responseText)
                }
            });
        }


        function uploadProofAction(key) {
            //wager3
            //console.log('work');
            $("#wager3").css("display", "block");
            $("#overlayDispute").css("display", "block");
            $("#wager3").addClass('show');


            $('.title1').text("");
            $('.title2').text("");
            $('.title3').text("");
            $('.title4').text("");
            this.endMatchid = key.match_id;
            //console.log(key);
            if (key.game_type == 2) {
                $('#gametype').text("2 V 2");
                $('.gametype').text("2 V 2");
            } else if (key.game_type == 1) {
                $('#gametype').text("1 V 1");
                $('.gametype').text("1 V 1");
            }
            $('#platform').text("Platform: " + key.platform);
            $('.platform').text("Platform: " + key.platform);
            $('#region').text("Region: " + key.region);
            $('.region').text("Region: " + key.region);
            $('#time').text("Time: " + key.time);
            $('.time').text("Time: " + key.time);
            $('#bid').text("Amount: " + key.bid_amount);
            $('.bidamount').text("Amount: " + key.bid_amount);


            $.ajax({
                url: '/api/viewBoxFightTeam/' + key.match_id,
                type: 'GET',

                //data: details,
                success: function (data) {
                    console.log(data);
                    if (data[0].game_type == 1) {
                        $('.title1').text(data[0].username);
                        $('.title2').text("");
                        $('.title3').text(data[1][0].username);
                        //console.log(data[1][0].username);
                        $('.title4').text("");
                    } else {
                        $('.title1').text(data[0].username);
                        $('.title2').text(data[1].username);
                        $('.title3').text(data[2][0].username);
                        $('.title4').text(data[2][1].username);
                    }

                },
                error: function (request, status, error) {

                    console.log(request.responseText)
                }
            });


        }

        function uploadProofActionClose() {
            //wager3
            $("#wager3").css("display", "none");
            $("#overlayDispute").css("display", "none");
            $("#wager3").removeClass('show');

        }



        function pictureUpload(e) {
            //console.log(e);
            //let uploadedFiles = e.files[0];
            //uploadedFiles = document.querySelector('input[type=file]').files[0];
            uploadedFiles = document.querySelector('#files').files[0];
            upload_counter=upload_counter+1;
            upload_flag_1=true;
            // var x;
            // x= document.querySelector('#files').files[0];
            // console.log(x);
            //console.log(file);
            for (var i = 0; i < uploadedFiles.length; i++) {
                this.files.push(uploadedFiles[i]);
            }
            //this.getImagePreviews();
        }

        function pictureUpload1(e) {
            //console.log(e);
            //let uploadedFiles = e.files[0];
            //uploadedFiles = document.querySelector('input[type=file]').files[0];
            uploadedFiles1 = document.querySelector('#files1').files[0];
            upload_counter=upload_counter+1;
            upload_flag_2=true;
            // var x;
            // x= document.querySelector('#files').files[0];
            // console.log(x);
            //console.log(file);
            for (var i = 0; i < uploadedFiles.length; i++) {
                this.files.push(uploadedFiles[i]);
            }
            //this.getImagePreviews();
        }

        // function getImagePreviews() {
        //     for (let i = 0; i < this.files.length; i++) {
        //         if (/\.(jpe?g|png|gif|mp4|mkv)$/i.test(this.files[i].name)) {
        //             let reader = new FileReader();
        //             reader.addEventListener("load", function () {
        //                 //this.$refs['preview'+parseInt(i)][0].src = reader.result;
        //             }.bind(this), false);
        //             reader.readAsDataURL(this.files[i]);
        //         } else {
        //             this.$nextTick(function () {
        //                 this.$refs['preview' + parseInt(i)][0].src = '/img/generic.png';
        //             });
        //         }
        //     }
        //     console.log(uploadedFiles);
        // }

        function submitFiles() {
            $("#upload_button_pre").css("display", "none");
            $("#upload_button_post").css("display", "block");
            //console.log(id);
            //if(this.files){
            //for( let i = 0; i < this.files.length; i++ ){
            // if(this.files[i].id) {
            //     continue;
            // }
        if(upload_flag_1){
                    let formData = new FormData();
                    //console.log(uploadedFiles)
                    formData.append('file', uploadedFiles);
                    @if(Auth::check())
                    var id = "<?php echo auth()->user()->id; ?>";
                    @endif
                    formData.append('user_id',id);
                    var pass=this.endMatchid;
                    //console.log(formData);
                    $.ajax({
                        url: '/api/file/' + pass,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function (data) {
                            complete_counter=complete_counter+1;
                            if(complete_counter==upload_counter)
                            {
                                if (data=='statusError')
                                {
                                    $("#resultTimeOut").css("display", "block");
                                    setTimeout(() => $("#resultTimeOut").css("display", "none"), 3000);
                                    if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                                    {
                                        setTimeout(() =>  location.reload(), 3000);
                                        }
                                    else
                                    {
                                        setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 3000);
                                        }
                                }


                                else
                                {
                                    if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                                    {
                                        setTimeout(() =>  location.reload(), 1000);
                                    }
                                    else
                                    {
                                        setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 1000);
                                    }
                                }

                            }

                        },
                        error: function (request, status, error) {

                            console.log(request.responseText)
                        }
                    });
             }

             if(upload_flag_2){
                    let formData1 = new FormData();
                    //console.log(uploadedFiles)
                    formData1.append('file', uploadedFiles1);
                    @if(Auth::check())
                    var id = "<?php echo auth()->user()->id; ?>";
                    @endif
                    formData1.append('user_id',id);
                    var pass=this.endMatchid;
                    //console.log(formData);
                    $.ajax({
                        url: '/api/file1/' + pass,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData1,
                        success: function (data) {

                            complete_counter=complete_counter+1;
                            if(complete_counter==upload_counter)
                            {
                                if (data=='statusError')
                                {
                                    $("#resultTimeOut").css("display", "block");
                                    setTimeout(() => $("#resultTimeOut").css("display", "none"), 3000);
                                    if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                                    {
                                        setTimeout(() =>  location.reload(), 3000);
                                        }
                                    else
                                    {
                                        setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 3000);
                                        }
                                }


                                else
                                {
                                    if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                                    {
                                        setTimeout(() =>  location.reload(), 1000);
                                    }
                                    else
                                    {
                                        setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 1000);
                                    }
                                }
                            }

                        },
                        error: function (request, status, error) {

                            console.log(request.responseText)
                        }
                    });
             }
            // axios.post('/api/file/'+id,
            //     formData,
            //     //id,
            //     {
            //         headers: {
            //             'Content-Type': 'multipart/form-data'
            //         }
            //     }
            // ).then(function(data) {
            //     this.files[i].id = data['data']['id'];
            //     this.files.splice(i, 1, this.files[i]);
            //     console.log('success');
            //     //formData.delete('file');
            //     //formData=null;
            //     this.files.pop();
            //     this.mountMethod();
            // }.bind(this)).catch(function(data) {
            //     console.log('error');
            // });
            // }
            // }//
        }

        jQuery(document).ready(function () {

            @if(strtoupper($game->name ) == "FORTNITE")
                    //console.log('fort');
                    refreshlink='1';
                    //setTimeout(() =>  window.location.href = '/tournaments-1?status=true#bt-role', 1000);
                @endif

                @if(strtoupper($game->name ) == "CALL OF DUTY")
                //console.log('call');
                refreshlink='2';

                    //setTimeout(() =>  window.location.href = '/tournaments-2?status=true#bt-role', 1000);
                @endif

            console.log('refreshlink');
            const urlParams = new URLSearchParams(window.location.search);
            const myParam = urlParams.get('status');
            if(myParam=='true'){
                $("#bx-role").css("display", "block");
                $("#join-fight-list").css("display", "block");
                // $('html, body').animate({
                //     scrollTop: $("#bx-role").offset().top
                // }, 1000);
                // $('#bx-role')[0].scrollIntoView(true);
            }


            var details={};


            $("#joinUsingButton").submit(function(e){

e.preventDefault();
details['match_id']=selectedMatch;
console.log('hi'+selectedMatch)
details['team_id']=0;
@if(Auth::check())
    details['user_id']="<?php echo auth()->user()->id; ?>";
@endif
    details['username']=$('#usernameWithButton').val();
//console.log(key);
$.ajax({
    url: '/api/checkBoxFightButton/'+selectedMatch,
    type: 'POST',

    data: details,
    success: function (data) {
        //console.log(data);
        if(data=="new"){
            $("#UserExistsMsg").css("display", "none");
            $.ajax({
                url: '/api/joinButton/'+selectedMatch,
                type: 'POST',

                data: details,
                success: function (data) {
                    if(data=='Failed'){
                        $("#limaError1").css("display", "block");
                        setTimeout(() => $("#limaError1").css("display", "none"), 3000);
                    }
                    else if(data=='match'){
                        $("#existsMatch").css("display", "block");
                        setTimeout(() => $("#existsMatch").css("display", "none"), 3000);
                    }
                    else if(data=='matchL'){
                        $("#existsMatchLive").css("display", "block");
                        setTimeout(() => $("#existsMatchLive").css("display", "none"), 3000);
                    }
                    else if(data=='cancel'){
                        $("#matchCancel").css("display", "block");
                        setTimeout(() => $("#matchCancel").css("display", "none"), 3000);
                    }
                    else if(data=='statusError'){
                        $("#joinTimeOut").css("display", "block");
                        setTimeout(() => $("#joinTimeOut").css("display", "none"), 3000);
                        if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {
                            setTimeout(() =>  location.reload(), 3000);
                            }
                        else
                        {
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 3000);
                            }
                    }
                    else{
                        $("#limaError1").css("display", "none");
                        $("#UserExistsMsg1").css("display", "inline-block");
                        $('#UserExistsMsg1').text('You have successfully joined this fight');


                        if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {setTimeout(() =>  location.reload(), 2000);}
                        else{
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 2000);
                        }


                    }
                },
                error: function (request, status, error) {

                    console.log(request.responseText)
                }
            });
        }
        else if(data=="exists"){
            $("#UserExistsMsg").css("display", "inline-block");
            $('#UserExistsMsg').text('You have already joined this fight');
            setTimeout(() => $("#UserExistsMsg").css("display", "none"), 5000);

        }
    },
    error: function (request, status, error) {

        console.log(request.responseText)
    }
});





});






            $("#close_icon").click(function () {

                //location.reload(true);

                if(window.location.href==window.location.origin+'/tournaments-'+refreshlink+'?status=true#bt-role')
                        {location.reload();}
                        else{
                            setTimeout(() =>  window.location.href = '/tournaments-'+refreshlink+'?status=true#bt-role', 000);
                        }


            });


            $("#cpa_form").submit(function (e) {
                e.preventDefault();
                var box = {};
                box['platform'] = $('.platform').val();
                box['bid_amount'] = $('.bid').val();
                box['game_type'] = $("input[name='fooby[1][]']:checked").val();

                @if(Auth::check())
                    box['user_id'] = "<?php echo auth()->user()->id; ?>";
                @endif
                if (box['game_type'] == 1) {
                    $(".same_team").css("display", "none");
                } else {
                    $(".same_team").css("display", "inline-block");
                }
                box['region'] = $('.region').val();
                //box['time'] = $('.time_start').val();
                //box['date'] = $('.date_start').val();
                box['username'] = $('.username').val();
                var testingTime=$('.date_start').val()+' '+$('.time_start').val();

                var t= new Date(testingTime);
                var localTime = t.getTime();
                var localOffset = t.getTimezoneOffset() * 60000;
                var utc = localTime + localOffset;
                var nd = new Date(utc);
                let month = nd.getMonth()+1;
                let year = nd.getFullYear();
                let day = nd.getDate();
                let hour = nd.getHours();
                let min = nd.getMinutes();
                var completedate= year +'-'+ month + '-' + day ;
                var completetime= hour +':' + min;
                box['time']=completetime;
                box['date']=completedate;

                @if(strtoupper($game->name ) == "FORTNITE")
                    box['game_id'] = 1;
                @endif

                    @if(strtoupper($game->name ) == "CALL OF DUTY")
                    box['game_id'] = 2;
                @endif



                $.ajax({
                    url: '/api/createBoxFight',
                    type: 'POST',

                    data: box,
                    success: function (data) {
                        if (data == 'Failed') {
                            $("#limaError").css("display", "block");
                            setTimeout(() => $("#limaError").css("display", "none"), 3000);
                        }
                        else if (data == 'nobox') {
                            $("#limaErrorOut").css("display", "block");
                            setTimeout(() => $("#limaErrorOut").css("display", "none"), 3000);
                        }
                        else if (data == 'match') {
                            $("#alreadyMatch").css("display", "block");
                            setTimeout(() => $("#alreadyMatch").css("display", "none"), 3000);
                        }
                        else if (data == 'matchL') {
                            $("#alreadyMatchLive").css("display", "block");
                            setTimeout(() => $("#alreadyMatchLive").css("display", "none"), 3000);
                        }
                        else {
                            $('.oppo').val(data['opponent_team']);
                            $('.same').val(data['same_team']);
                            // $('.oppo').val()=data['opponent_team'];
                            // $('.same').val()=data['same_team'];
                            // $('.oppo').val("value = " + $('#number').val().replace("placeholder", data));
                            // $('.same').val("value = " + $('#number').val().replace("placeholder", data));
                            $("#limaError").css("display", "none");
                            $("#createfight").css("display", "none");
                            $("#sharelink").css("display", "block");
                            $("#sharelink").addClass('show');
                        }
                    },
                    error: function (request, status, error) {

                        console.log(request.responseText)
                    }
                });
            });


        });
    </script>

    <script>
        $(document).ready(function () {

            $('._card').click(function () {
                $("._options_div").hide();
                $("._details").hide();
                $($(this).data('control')).show();
            });

            $('._option').click(function () {
                $("._details").hide();
                $($(this).data('control')).show();
            });


            $(document).on('click', ".copy-link", function () {
                $(this).closest(".input-group").find('input').select();
                document.execCommand('copy');
            })


            $(document).on('click', ".upload-evidence", function () {
                $("#e-team-id").val($(this).data('team_id'));
                $("#e-match-id").val($(this).data('match_id'));

            })

            $('.ajax-form').on('submit',function (event) {
                event.preventDefault();
                var form = $(this);
                var modalId = form.closest(".modal").attr('id');
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    type: "post",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.status) {
                            $("#"+modalId).modal('toggle');
                            setTimeout(
                                function()
                                {
                                    form.closest('div.ajax-result').html(response.html);
                                    alert(response.msg)
                                }, 500);
                        }else {
                            alert(response.msg)
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var data =  jqXHR.responseJSON
                        alert(data.message)
                    }

                });
            })


            $(".bracket_link").on("click",function () {

                let tour_id = $(this).attr('data-tournament_id');
                let target = $(this).attr('data-control');
                $.ajax({
                        url: 'get-bracket-details',
                        type: "post",
                        data: {
                            tournament: tour_id,
                        },
                        dataType: 'json',
                        success: function (response) {
                            $(target).bracket({
                                init: response,
                            });
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }

                    });
            })

        });




    </script>
@endpush
