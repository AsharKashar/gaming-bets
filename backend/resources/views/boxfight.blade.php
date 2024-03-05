@extends('layout.mainlayout')


@section('content')

    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area bc-tournaments" >
  <div class="container tag" style="height: 300px">
        <img class="cover image" src="/assets/images/game/fn2.jpg" alt="" >
        <div class="middle">
                <div class="texte">Box Fight Wagers</div>
                <div class="row" style="margin-left: 100px">
                 <div class="links">
                                
                    <a href="" class="sign-in mybtn1" data-toggle="modal" data-target="#Wager1">wager 1</a>
                </div>
                   <div class="links">
                                
                    <a href="" class="sign-in mybtn1" data-toggle="modal" data-target="#Wager2">wager 2</a>
                </div>
                   <div class="links">
                                
                    <a href="" class="sign-in mybtn1" data-toggle="modal" data-target="#Wager3">wager 3</a>
                </div></div>
              </div>                                            
        </div>
    </section>
    <section class="tournaments">
        <div class="info-table">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pills-all-player" role="tabpanel"
                                     aria-labelledby="pills-all-player-tab">
                                    <div class="inner-table-content">
                                        <div class="header-area">
                                            <ul class="nav" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="Overviews-tab" data-toggle="tab" href="#Overviews" role="tab"
                                                       aria-controls="Overviews" aria-selected="true">Overview</a>
                                                </li>                                       
                                                <li class="nav-item">
                                                    <a class="nav-link" id="Matchess-tab" data-toggle="tab" href="#Matchess" role="tab"
                                                       aria-controls="Matchess" aria-selected="false">Matches</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link " id="Ruless-tab" data-toggle="tab" href="#Ruless" role="tab"
                                                       aria-controls="Ruless" aria-selected="false">Rules</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">                                           
                                            <div class="tab-pane fade" id="Matchess" role="tabpanel" aria-labelledby="Matchess-tab">
                                                <!-- Team Area Start -->
                                                <section class="team">
                                                    <div class="top-area">                                                      
                                                        <div class="container">
                                                            <div class="row justify-content-center" style="margin-top:-90px">
                                                                <div class="col-lg-8 col-md-10">
                                                                    <div class="section-heading">
                                                                        <h2 class="title">
                                                                            Matches
                                                                         </h2>
                                                                         <p class="text">
                                                                           Here you can view all available wangers! Select your platform, region, solos or duos and the amount your willing to wager to prove your worth.
                                                                         </p>
                                                                    </div>
                                                                </div>
                                                            </div>                                                         
                                                            <div class="inner-table">
                                                                <div class="responsive-table">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>                                                                               
                                                                                <th>Match Type</th>
                                                                                <th>Platform</th>
                                                                                <th>Region</th>
                                                                                <th>Wager Amount</th>
                                                                                <th>Started Time</th>
                                                                                <th>Hosted By</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                                <td>1 vs 1</td>
                                                                                <td>PC</td>
                                                                                <td>EU</td>
                                                                                <td>1,000(coin logo)</td>
                                                                                <td>Tue 13:00 CET</td>
                                                                                <td>AGKMaster</td>
                                                                                <td><a style="margin-top: 0px" href="" class="mybtn1">Join</a></td>                                                                  
                                                                            </tr>
                                                                            <tr>
                                                                                <td>2 vs 2</td>
                                                                                <td>Xbox</td>
                                                                                <td>NA East</td>
                                                                                <td>500(coin logo)</td>
                                                                                <td>Tue 16:00 CET</td>
                                                                                <td>Borja</td>
                                                                                <td><a style="margin-top: 0px" href="" class="mybtn1">Join</a></td>                                                                  
                                                                            </tr>
                                                                            </tbody>
                                                                    </table>
                                                                </div>                                                                    
                                                            </div>
                                                      </div>
                                                    </div>
                                                </section>
                                                <!-- Team Area End -->
                                            </div>
                                            <div class="tab-pane fade" id="Ruless" role="tabpanel" aria-labelledby="Ruless-tab">
                                              <section class="faq-section">
                                                <div class="faq-wrapper">
                                                <div class="accordion sorteo-accordion" id="accordionExample4">
                                                    <div class="card">
                                                        <div class="card-header" id="headingNine">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine"><i class="fa fa-question"></i>Rule No#1</button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample4">
                                                            <div class="card-body">
                                                                <p>Once you join or are invited to a wager and accept the terms of the matchup, you are required to fill in all required information and deposit the full amount of bombs agreed to.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="headingTen">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen"><i class="fa fa-question"></i>Rule No#2</button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample4">
                                                            <div class="card-body">
                                                                <p>The host is then required to invite all participants to a private party within 15 minutes from the start time. If the host fails to do so, the matchup will be cancelled, and the deposited amount is returned to all parties.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="heading11">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11"><i class="fa fa-question"></i>Rule No#3</button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapse11" class="collapse show" aria-labelledby="heading11" data-parent="#accordionExample4">
                                                            <div class="card-body">
                                                                <p>The host will then create a private lobby in the creative games mode on Fortnite. Once all players have joined the lobby, the host will load up the Bangergames best of 9 box 2 box fight map and start game.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="heading12">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12"><i class="fa fa-question"></i>Rule No#4</button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordionExample4">
                                                            <div class="card-body">
                                                                <p>The solos/duos will then battle it off, the first to 5 wins is announced the victor.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="heading13">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13"><i class="fa fa-question"></i>Rule No#5</button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordionExample4">
                                                            <div class="card-body">
                                                                <p>Once the match is complete users will be required to select the 'match completed' button on the bangergames website tab. They will then choose whether they won or lost depending on the outcome of the box 2 box fight.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="heading14">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse14" aria-expanded="false" aria-controls="collapse14"><i class="fa fa-question"></i>Rule No#6</button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapse14" class="collapse" aria-labelledby="heading14" data-parent="#accordionExample4">
                                                            <div class="card-body">
                                                                <p>The winner or winners of the wager will receive the bombs directly into their accounts and secure a win to their record.</p>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="card">
                                                        <div class="card-header" id="heading15">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse15" aria-expanded="false" aria-controls="collapse15"><i class="fa fa-question"></i>Rule No#7</button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapse15" class="collapse" aria-labelledby="heading15" data-parent="#accordionExample4">
                                                            <div class="card-body">
                                                                <p>Note, if a user does not respond to the game result within 45 minutes, the match result will go in favour of the vote that was submitted. If two users submit the same result than each party will be required to provide a photo and video evidence using the upload button that will appear on bangergames.com. The proof will be reviewed, and the real victor will be rewarded within 2 hours. The user who submitted false results will be banned from using bangergames.com services.</p>
                                                            </div>
                                                        </div>
                                                    </div>                                
                                                </div>
                                            </div>
                                     </section>
                                            </div>
                                            <div class="tab-pane fade show active" id="Overviews" role="tabpanel" aria-labelledby="Overviews-tab">                         
                                                 <!-- Team Area Start -->
                                                 <section class="team">
                                                    <div class="top-area">                                                        
                                                        <div class="container">
                                                            <div class="row justify-content-center" style="margin-top:-90px">
                                                                <div class="col-lg-8 col-md-10">
                                                                    <div class="section-heading">          
                                                                        <h2 class="title">
                                                                           Overview
                                                                        </h2>
                                                                        <p class="text">
                                                                          Here is where the best of the best face off in 1v1s and 2v2s to decide who is the best player.
                                                                        </p>
                                                                        <p class="text">
                                                                            
                                                                          </p>
                                                                          <p class="text">
                                                                            Create a match, purchase some bombs, set your wager amount, invite your friends or post to challenge any willing player.
                                                                          </p>
                                                                          <p class="text">
                                                                            Invite the gamers to your private party, load up a private creative lobby and join the Bangergames box fight map.
                                                                          </p>
                                                                          <p class="text">
                                                                            Once the best of 9 box fight starts, the first solo/duo with 5 wins takes home everything.
                                                                          </p>
                                                                          <p class="text">
                                                                            When a solo/duo has won, open up the Bangergames tab and press match finished. Then click the button winner or loser according to the final result. Once the results are in by both teams, the winners will be rewarded the total wagered amount in bombs.
                                                                          </p>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       </div>
                                                    </div>
                                              </section>
                                                <!-- Team Area End -->                                               
                                            </div>
                                        </div>
                                        <!-- Team Area End --> 
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tournaments Area End -->
@endsection
