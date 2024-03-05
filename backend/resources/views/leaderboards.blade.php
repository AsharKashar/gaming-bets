@extends('layout.indexlayout')


@section('content')

    <!-- ladderboard Area Start -->
    <div class="container-fluid ladderboard">
        <div class="ladderboard-toparea">
            <div class="container">
                <div class="row" >
                    <div class="col-lg-6 col-sm-6"><h4 class="leader-f1">Leaderboards</h4>
                <br>
            <h4 class="leader-f1-1">Work your way up the leader to earn rewards</h4>
        <br><h4 class="leader-f1-2">Work your way up the leader to earn rewards Work your way up the leader to earn rewards Work your way up the leader to earn rewards Work your way up the leader to earn rewards</h4></div>
                    <div class="col-lg-3 leader-f2 col-sm-3"><ul class="navbar-nav1 ">
                                <li class="nav-item active ">
                                    <a style="" id="COD" class="nav-link leader-link" >Call of Duty </a>
                                    <a style="margin-top:-20px" class="nav-link leader-link" id="Fortnite">Fortnite</a>
                                    <a style="margin-top:-20px" class="nav-link leader-link" id="csgo">csgo</a>
                                    <a style="margin-top:-20px" class="nav-link leader-link" id="top-month">top of the month</a>
                                </li>
                            </ul></div>
                    <div class="col-lg-3 leader-f2 col-sm-3" id="COD-details"><ul class="navbar-nav1">
                                <li class="nav-item active ">
                                    <a style="" id="Modern-Warfare" class="nav-link leader-link" >Modern Warfare </a>
                                    <a style="margin-top:-20px" class="nav-link leader-link" id="warzone">warzone</a>
                                    
                                       
                                </li>
                            </ul></div>
                </div>
            </div>
            
        </div>
    </div>
    
            <!-- Fun fact Area Start -->
            <div class="funfact ladderboard">
            <div class="container-fluid" id="top-month-details">
            <!-- Fun fact Area Start -->
        <div class="funfact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6"><h2 class="top-title" style="">
                               Top of the month
                                </h2></div>
                                <div class="col-lg-6 col-sm-6"><p class="top-paragraf">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.</p></div>
     

                    <div class="row" style="margin-top:50px;margin-left-10pxs">

                        <div class="single-fun col-lg-4 col-sm-4">
                            <div class="top-player-card">
                            <img style="width:85%" src="assets/images/Content-coder/bow_1.gif" alt="">
                            <div class="count-area">
                                <div class="count">1st</div>
                            </div>
                            <p>
                                
                            </p>
</div>
                        </div>


                        <div class="single-fun col-lg-4 col-sm-4">
                        <div class="top-player-card">
                            <img style="width:85%" src="assets/images/Content-coder/bow_2.gif" alt="">
                            <div class="count-area">
                                <div class="count">2nd</div>
                            </div>
                            <p>
                                
                            </p>
</div>
                        </div>


                        <div class="single-fun col-lg-4 col-sm-4">
                        <div class="top-player-card">
                            <img style="width:85%" src="assets/images/Content-coder/bow_1.gif" alt="">
                            <div class="count-area">
                                <div class="count">3rd</div>
                            </div>
                            <p>
                                
                            </p>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fun fact Area End -->
        <div class="container">
        <div class="row"><h4 class="leader-page-timer" >23:04:14</h4></div>
        <div class="row"><h4 class="timer-tag"> <span class="space1">HRS</span><span class="space1">MIN</span><span class="space1">SEC</span></h4></div>
</div>
                </div>
                
            </div>
            <div class="funfact ladderboard">
            <div class="container" id="warefare-leader">
            
                <div class="row">
                
                    <div class="col-lg-12 col-sm-12">
                <div class="responsive-table">
                        <table class="table" style="color:#a1afd3;margin-bottom:165px">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">Place</th>
                                <th style="border-top:none" scope="col">Team</th>
                                <th style="border-top:none" scope="col">WL</th>
                                <th style="border-top:none" scope="col">WR</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--@foreach($ladder as $team)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>

                                        <a href="{{url('/profile_'.$team->user->id)}}">{{$team->user->name}}</a>
                                    </td>
                                    <td>{{$team->points}}</td>
                                    <td>{{$team->winning}}</td>
                                </tr>
                            @endforeach-->
                                <tr>
                                    <td class="leader-table-td">1</td>
                                    <td class="leader-table-td">

                                        <a href="" class="leader-table-td">ajk master</a>
                                    </td>
                                    <td style="color:#bf1438" class="leader-table-td">13.00</td>
                                    <td style="color:#bf1438" class="leader-table-td">1700.00</td>
                                </tr>
                                <tr>
                                    <td class="leader-table-td">2</td>
                                    <td class="leader-table-td">

                                        <a href="" class="leader-table-td">ajk master</a>
                                    </td>
                                    <td style="color:#bf1438" class="leader-table-td">13.00</td>
                                    <td style="color:#bf1438" class="leader-table-td">1700.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
</div>

                </div>
            </div>
            <div class="container" id="warzone-leader">
                <div class="row">
                <div class="col-lg-12 col-sm-12">
                <div class="responsive-table">
                        <table class="table" style="color:#a1afd3;margin-bottom:165px">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">Place</th>
                                <th style="border-top:none" scope="col">Team</th>
                                <th style="border-top:none" scope="col">WL</th>
                                <th style="border-top:none" scope="col">WR</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--@foreach($ladder as $team)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>

                                        <a href="{{url('/profile_'.$team->user->id)}}">{{$team->user->name}}</a>
                                    </td>
                                    <td>{{$team->points}}</td>
                                    <td>{{$team->winning}}</td>
                                </tr>
                            @endforeach-->
                                <tr>
                                    <td class="leader-table-td">1</td>
                                    <td class="leader-table-td">

                                        <a href="" class="leader-table-td">ajk master</a>
                                    </td>
                                    <td style="color:#bf1438" class="leader-table-td">13.00</td>
                                    <td style="color:#bf1438" class="leader-table-td">1700.00</td>
                                </tr>
                                <tr>
                                    <td class="leader-table-td">2</td>
                                    <td class="leader-table-td">

                                        <a href="" class="leader-table-td">ajk master</a>
                                    </td>
                                    <td style="color:#bf1438" class="leader-table-td">13.00</td>
                                    <td style="color:#bf1438" class="leader-table-td">1700.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
</div>
                </div>
            </div>
            <div class="container" id="fortnite-leader">
                <div class="row">
                <div class="col-lg-12 col-sm-12">
                <div class="responsive-table">
                        <table class="table" style="color:#a1afd3;margin-bottom:165px">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">Place</th>
                                <th style="border-top:none" scope="col">Team</th>
                                <th style="border-top:none" scope="col">WL</th>
                                <th style="border-top:none" scope="col">WR</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--@foreach($ladder as $team)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>

                                        <a href="{{url('/profile_'.$team->user->id)}}">{{$team->user->name}}</a>
                                    </td>
                                    <td>{{$team->points}}</td>
                                    <td>{{$team->winning}}</td>
                                </tr>
                            @endforeach-->
                                <tr>
                                    <td class="leader-table-td">1</td>
                                    <td class="leader-table-td">

                                        <a href="" class="leader-table-td">ajk master</a>
                                    </td>
                                    <td style="color:#bf1438" class="leader-table-td">13.00</td>
                                    <td style="color:#bf1438" class="leader-table-td">1700.00</td>
                                </tr>
                                <tr>
                                    <td class="leader-table-td">2</td>
                                    <td class="leader-table-td">

                                        <a href="" class="leader-table-td">ajk master</a>
                                    </td>
                                    <td style="color:#bf1438" class="leader-table-td">13.00</td>
                                    <td style="color:#bf1438" class="leader-table-td">1700.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
</div>
                </div>
            </div>
            <div class="container" id="csgo-leader">
                <div class="row">
                <div class="col-lg-12 col-sm-12">
                <div class="responsive-table">
                        <table class="table" style="color:#a1afd3;margin-bottom:165px">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">Place</th>
                                <th style="border-top:none" scope="col">Team</th>
                                <th style="border-top:none" scope="col">WL</th>
                                <th style="border-top:none" scope="col">WR</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--@foreach($ladder as $team)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>

                                        <a href="{{url('/profile_'.$team->user->id)}}">{{$team->user->name}}</a>
                                    </td>
                                    <td>{{$team->points}}</td>
                                    <td>{{$team->winning}}</td>
                                </tr>
                            @endforeach-->
                                <tr>
                                    <td class="leader-table-td">1</td>
                                    <td class="leader-table-td">

                                        <a href="" class="leader-table-td">ajk master</a>
                                    </td>
                                    <td style="color:#bf1438" class="leader-table-td">13.00</td>
                                    <td style="color:#bf1438" class="leader-table-td">1700.00</td>
                                </tr>
                                <tr>
                                    <td class="leader-table-td">2</td>
                                    <td class="leader-table-td">

                                        <a href="" class="leader-table-td">ajk master</a>
                                    </td>
                                    <td style="color:#bf1438" class="leader-table-td">13.00</td>
                                    <td style="color:#bf1438" class="leader-table-td">1700.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
</div>
                </div>
            </div>
            </div>
        <!-- Fun fact Area End -->
    </section>
        <!-- ladderboard Area End -->
    <!-- 404 Area Start -->
          <!-- 404 Area End -->
 

    
    <script>
        $(document).ready(function(){
            
        });
        </script>
@endsection
