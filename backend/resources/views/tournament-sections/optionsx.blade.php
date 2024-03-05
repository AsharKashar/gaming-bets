<?php
$matches = $tour->getMatches();

?>
<section style="background:#010432">
<div class="container detail-box-fixed t-d _options_div" id="options-{{$tour->id}}" style="display:none;">
    <div class="row ar" style="">
        <div class="col-lg-3 col-sm-3">
            <h4 class="s1" style="">Tournament Details</h4>
        </div>
        <div class="col-lg-4 col-sm-4">
            <ul class="navbar-nav1 s2">
                <li class="nav-item active s2-1">
                    <a style="" class="nav-link s2-1-1 _option" data-control="#overview-{{$tour->id}}" href="#overview-{{$tour->id}}">Overview</a>
                    <a style="margin-top:-20px" class="nav-link s2-1-1 _option bracket_link" data-tournament_id="{{$tour->id}}" data-control="#bracket-{{$tour->id}}">Brackets</a>
                    <a style="margin-top:-20px" class="nav-link s2-1-1 _option" data-control="#teams-{{$tour->id}}">Teams</a>
                    <a style="margin-top:-20px" class="nav-link s2-1-1 _option" data-control="#matches-{{$tour->id}}">Matches</a>
                    <a style="margin-top:-20px" class="nav-link s2-1-1 _option" data-control="#all-rewards-{{$tour->id}}" href="#all-rewards-{{$tour->id}}">SEE ALL REWARDS</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</section>
<div class="container-fluid detail-box-fixed _details" style="display:none;margin-top:-45px;padding-bottom:20px" id="overview-{{$tour->id}}">
    <div class="container detail-box-fixed">
        
        <div class="row" style="margin-top:43px">
            <div class="col-lg-4">
                <h4 class="tournament-card-detail-text">1<sup>st</sup>
                </h4>
            </div>
            <div class="col-lg-4 ">
                <h4 class="tournament-card-detail-text">2<sup>nd</sup>
                </h4>
            </div>
            <div class="col-lg-4 ">
                <h4 class="tournament-card-detail-text">3<sup>rd</sup>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ">
                <h4 class="tournament-card-detail-text2">REWARD &euro;{{$tour->reward_1}}</h4>
            </div>
            <div class="col-lg-4 ">
                <h4 class="tournament-card-detail-text2">REWARD &euro;{{$tour->reward_2}}</h4>
            </div>
            <div class="col-lg-4 ">
                <h4 class="tournament-card-detail-text2">REWARD &euro;{{$tour->reward_3}}</h4>
            </div>
        </div>
        <div class="row" style="margin-top:78px">
            <div class="col-lg-3">
                <h4 class="tournament-card-detail-table-text">Hosted by </h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text1">{{$tour->hosted_by}}</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Regions </h4>
            </div>
            <div class="col-lg-3">
                <h4 class="tournament-card-detail-table-text1">{{$tour->regions}}</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Game</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text1">{{$game->name}}</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Pool Prize</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text1">{{$tour->getRewardTotal()}}&euro;</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Entry Fee</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text1">{{$tour->entry_fee}}</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Team Size</h4>
            </div>
            <div class="col-lg-3">
                <h4 class="tournament-card-detail-table-text1">{{$tour->team_size}}</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Platform</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text1">{{$tour->platforms}}</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Bracket Size</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text1">{{$tour->bracket_size}} Teams</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <h4 class="tournament-card-detail-table-text">Start</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text1">{{$tour->start_at->diffForHumans()}}</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Bracket Type </h4>
            </div>
            <div class="col-lg-3">
                <h4 class="tournament-card-detail-table-text1">{{$tour->bracket_type}}</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Registration </h4>
            </div>
            <div class="col-lg-3">
                <h4 class="tournament-card-detail-table-text1">{{$tour->reg_start_at->diffForHumans()}}</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text">Team Registered</h4>
            </div>
            <div class="col-lg-3 ">
                <h4 class="tournament-card-detail-table-text1">{{$tour->teams()->count()}}</h4>
            </div>
        </div>
        <hr>
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-2 tour-tex" ><i style="color:#bf1338" class="fas fa-circle"></i>live</div>
                    <div class="col-lg-3 tour-tex">Review rules</div>
                </div>
            </div>
        <div class="col-lg-6">
        <div class="row justify-content-end">
            @auth

                <?php
                $members = auth()->user()->hasTournamentTeam($tour->id);
                $team = $members ? $members->first()->team_id : null;
                ?>
            <div class="ajax-result">
                @if($members)
                    <div class="col-lg-12">
                        <button class="btn mybtn-tournament" style="margin-left:1%" data-toggle="modal" data-target="#team-members-{{$tour->id}}" type="button">TEAM DETAILS</button>
                    </div>
                    @include('modal.invite-modal',['members'=>$members,'id'=>$tour->id])
                @else
                    @if ($tour->isUpcoming())
                    <div class="row ">
                    <div class="col-lg-6">
                            <button class="btn mybtn-tournament" style="margin-left:-10px" type="button" data-toggle="modal" data-target="#make-team-{{$tour->id}}">MAKE TEAM</button>
                        </div>

                        <div class="col-lg-6" >
                            <button class="btn mybtn-tournament" type="button" data-toggle="modal" data-target="#join-team-{{$tour->id}}">JOIN TEAM</button>
                        </div>
                    </div>
                        
                        @include('modal.join-tournament',['tournament'=>$tour,])
                    @else
                        <h4>Tournament Registration time expired</h4>
                    @endif
                @endif
            </div>
                @if($tour->status == 'check_in' && auth()->user()->canCheckIn($tour->id))
                    <a href="{{route('check_in.tournament',$tour->id)}}" class="btn btn-lg mt-5 btn-danger rounded-pill">
                        <i class="fa fa-check"></i> Check In to tournament
                    </a>
                @endif


            @else
                <div class="col-lg-12">
                    <button class="btn mybtn-tournament" type="button">SIGN IN TO JOIN TOURNAMENT</button>
                </div>
            @endauth
        </div>
                </div>
           
        </div>
    </div>
</div>
<div class="container-fluid detail-box-fixed _details" style="display:none;margin-bottom:-10px;padding-bottom:20px" id="teams-{{$tour->id}}">
    <div class="container detail-box-fixed">
        <div class="row">

            @foreach($tour->teams as $team)
                <div class="col-lg-4">
                    <div class="team-box">
                        <div class="team-details">
                            <h4 class="team-name">{{$team->name}}</h4>
                        </div>
                        <div class="team-details">

                            <h4 class="team-members">
                                {{implode(', ', $team->members->pluck('name')->toArray())}}
                            </h4>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="container-fluid detail-box-fixed _details" style="display:none;margin-bottom: -10px;padding-bottom:20px" id="all-rewards-{{$tour->id}}">
    <div class="container detail-box-fixed">
    <div class="row">
    <div class="col-lg-6">
        <div class="positions-card">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="place-title"> 1<sup>st</sup> Place</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="reward-title">
                    {{$tour->reward_1}}&euro; REWARD
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="place-title"> 2<sup>nd</sup> Place</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="reward-title">
                    {{$tour->reward_2}}&euro; REWARD
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="place-title"> 3<sup>rd</sup> Place</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="reward-title">
                    {{$tour->reward_3}}&euro; REWARD
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 rewards-table">
    <div class="responsive-table">
                                                                    <table class="table" style="color:#a1afd3">
                                                                        <thead>
                                                                            <tr>
                                                                                <th  style="border-top:none">PLACE</th>
                                                                                <th  style="border-top:none">BOMBS</th>
                                                                                <th  style="border-top:none">POINTS</th>
                                                                                
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            <tr>
                                                                                <td>1</td>
                                                                                <td style="color:#bf1338">100</td>
                                                                                <td style="color:#bf1338">100</td>
                                                                                </tr>
                                                                            <tr>
                                                                                <td>2</td>
                                                                                <td style="color:#bf1338">50</td>
                                                                                <td style="color:#bf1338">50</td>
                                                                                
                                                                            </tr>
                                                                            </tbody>
                                                                    </table>
                                                                </div>
    </div>
</div>
    </div>
</div>
<section style="background:#010432">
<div class="container detail-box _details" style="display:none;margin-top:-10px" id="bracket-{{$tour->id}}">
    team bracket
</div>
</section>
@if (count($matches))
    <div class="container-fluid detail-box _details" style="display:none;margin-top:-10px;" id="matches-{{$tour->id}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="responsive-table table-wrapper-scroll-y">
                        <!--
                          <table class="table" style="color:#a1afd3">
                              <thead>
                              <tr>
                                  <th style="border-top:none" scope="col">Match Type</th>
                                  <th style="border-top:none" scope="col">Platform</th>
                                  <th style="border-top:none" scope="col">Region</th>
                                  <th style="border-top:none" scope="col">Amount</th>
                                  <th style="border-top:none" scope="col">Time</th>
                                  <th style="border-top:none" scope="col">Host By</th>
                                                                                                  <th scope="col">Level</th>
                              </tr>
                              </thead>
                              <tbody>


                              <tr>
                                  <td>1 vs 1</td>
                                  <td>
                                      PC

                                  </td>
                                  <td>Europ</td>
                                  <td style="color:#bf1438">1000.00</td>
                                  <td style="color:#bf1438">Tue. 13:00 CET</td>
                                  <td>AJK Master</td>
                                  <td style="color:#bf1438">
                                      <a style="color:#bf1438;text-decoration: underline;" data-toggle="modal" data-target="#join">JOIN</a>
                                  </td>
                              </tr>

                              </tbody>
                          </table>
          -->

                        <table class="table" style="color:#a1afd3">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">Title</th>
                                <th style="border-top:none" scope="col">Team A</th>
                                <th style="border-top:none" scope="col">Team B</th>
                                <th style="border-top:none" scope="col">Host</th>
                                <th style="border-top:none" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($matches as $match)
                                <tr>
                                    <td>{{$match->title}}</td>
                                    <td>{{$match->team1_name}}</td>
                                    <td>{{$match->team2_name}}</td>

                                    <td>{{ $match->hosted_by == $match->team_1 ? 'Team A' : "Team B" }}</td>
                                    <td style="color:#bf1438">
                                    @if ($team_id > 0)
                                        @if( ($match->team_1 ==  $team_id && $match->close_for1 == 0 ) || ($match->team_2 ==  $team_id && $match->close_for2 == 0 ) )
                                            <button class="btn btn-sm btn-danger upload-evidence" data-match_id="{{$match->match_id}}" data-team_id="{{$team_id}}" data-toggle="modal" data-target="#upload-form">Upload Evidence</button>
                                        @endif
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif
