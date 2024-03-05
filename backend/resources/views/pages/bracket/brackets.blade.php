@extends('layouts.app', ['page' => __('brackets'), 'pageSlug' => 'brackets'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('CALL OF DUTY BRACKET') }}</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">
                @include('alerts.success')

                <div class="row">
                    <div class="col-6">
                        <label>{{ __('Tournament') }}</label>
                        <select id="select_box" name="tournament" class="form-control{{ $errors->has('regions') ? ' is-invalid' : '' }}">
                            <option value="">default</option>
                                <option value="0">match 1</option>
                                <option value="1" >match 2</option>


                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">

                </nav>
            </div>
            <div id="0" class="hide">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                    <meta name="viewport" content="width=device-width,initial-scale=1.0">
                    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
                    <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
                    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script|Herr+Von+Muellerhoff' rel='stylesheet' type='text/css'>
                    <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
                    <link href='https://fonts.googleapis.com/css?family=Istok+Web|Roboto+Condensed:700' rel='stylesheet' type='text/css'>

                    <title>March Madness Stock Matchup</title>
                </head>
                <body>
                    <header class="hero">
                    <div class="hero-wrap">
                     <p class="intro" id="intro">flexbox</p>
                     <br><br><br>
                         <h1 id="headline">Tournament</h1>
                         <p class="year"><i class="fa fa-star"></i> 2015 <i class="fa fa-star"></i></p>
                     <p>Ballin' Outta Control</p>
                   </div>
                    </header>


                    <section id="bracket">
                    <div class="container">
                    <div class="split split-one">
                        <div class="round round-one current">
                            <div class="round-details">Round 1<br/><span class="date">March 16</span></div>
                            <ul class="matchup">
                                <li class="team team-top">Duke<span class="score">76</span></li>
                                <li class="team team-bottom">Virginia<span class="score">82</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Wake Forest<span class="score">64</span></li>
                                <li class="team team-bottom">Clemson<span class="score">56</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">North Carolina<span class="score">68</span></li>
                                <li class="team team-bottom">Florida State<span class="score">54</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">NC State<span class="score">74</span></li>
                                <li class="team team-bottom">Maryland<span class="score">92</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Georgia Tech<span class="score">78</span></li>
                                <li class="team team-bottom">Georgia<span class="score">80</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Auburn<span class="score">64</span></li>
                                <li class="team team-bottom">Florida<span class="score">63</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Kentucky<span class="score">70</span></li>
                                <li class="team team-bottom">Alabama<span class="score">59</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Vanderbilt<span class="score">64</span></li>
                                <li class="team team-bottom">Gonzaga<span class="score">68</span></li>
                            </ul>
                        </div>  <!-- END ROUND ONE -->

                        <div class="round round-two">
                            <div class="round-details">Round 2<br/><span class="date">March 18</span></div>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                        </div>  <!-- END ROUND TWO -->

                        <div class="round round-three">
                            <div class="round-details">Round 3<br/><span class="date">March 22</span></div>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                        </div>  <!-- END ROUND THREE -->
                    </div>

                <div class="champion">
                        <div class="semis-l">
                            <div class="round-details">west semifinals <br/><span class="date">March 26-28</span></div>
                            <ul class ="matchup championship">
                                <li class="team team-top">&nbsp;<span class="vote-count">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="vote-count">&nbsp;</span></li>
                            </ul>
                        </div>
                        <div class="final">
                            <i class="fa fa-trophy"></i>
                            <div class="round-details">championship <br/><span class="date">March 30 - Apr. 1</span></div>
                            <ul class ="matchup championship">
                                <li class="team team-top">&nbsp;<span class="vote-count">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="vote-count">&nbsp;</span></li>
                            </ul>
                        </div>
                        <div class="semis-r">
                            <div class="round-details">east semifinals <br/><span class="date">March 26-28</span></div>
                            <ul class ="matchup championship">
                                <li class="team team-top">&nbsp;<span class="vote-count">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="vote-count">&nbsp;</span></li>
                            </ul>
                        </div>
                    </div>


                    <div class="split split-two">


                        <div class="round round-three">
                            <div class="round-details">Round 3<br/><span class="date">March 22</span></div>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                        </div>  <!-- END ROUND THREE -->

                        <div class="round round-two">
                            <div class="round-details">Round 2<br/><span class="date">March 18</span></div>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">&nbsp;<span class="score">&nbsp;</span></li>
                                <li class="team team-bottom">&nbsp;<span class="score">&nbsp;</span></li>
                            </ul>
                        </div>  <!-- END ROUND TWO -->
                        <div class="round round-one current">
                            <div class="round-details">Round 1<br/><span class="date">March 16</span></div>
                            <ul class="matchup">
                                <li class="team team-top">Minnesota<span class="score">62</span></li>
                                <li class="team team-bottom">Northwestern<span class="score">54</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Michigan<span class="score">68</span></li>
                                <li class="team team-bottom">Iowa<span class="score">66</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Illinois<span class="score">64</span></li>
                                <li class="team team-bottom">Wisconsin<span class="score">56</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Purdue<span class="score">36</span></li>
                                <li class="team team-bottom">Boise State<span class="score">40</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Penn State<span class="score">38</span></li>
                                <li class="team team-bottom">Indiana<span class="score">44</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Ohio State<span class="score">52</span></li>
                                <li class="team team-bottom">VCU<span class="score">80</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">USC<span class="score">58</span></li>
                                <li class="team team-bottom">Cal<span class="score">59</span></li>
                            </ul>
                            <ul class="matchup">
                                <li class="team team-top">Virginia Tech<span class="score">74</span></li>
                                <li class="team team-bottom">Dartmouth<span class="score">111</span></li>
                            </ul>
                        </div>  <!-- END ROUND ONE -->
                    </div>
                    </div>
                    </section>
                    <section class="share">
                            <div class="share-wrap">
                                <a class="share-icon" href="https://twitter.com/_joebeason"><i class="fa fa-twitter"></i></a>
                                <a class="share-icon" href="#"><i class="fa fa-facebook"></i></a>
                                <a class="share-icon" href="#"><i class="fa fa-envelope"></i></a>
                            </div>
                    </section>



                Resources1×0.5×0.25×Rerun</div>
            <div id="1" class="hide">fd</div>
        </div>
    </div>
</div>

    <!-- Rematch Modal -->
    <div class="modal modal-black fade" id="rematchs" tabindex="-1" role="dialog" aria-labelledby="rematchs" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  id="rematchForm">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">{{__("Evidence")}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group{{ $errors->has('start_at') ? ' has-danger' : '' }}">
                            <label>{{ __('Team 1') }}</label>
                            <button type="button" class="btn btn-secondary" >Download Photo</button><button type="button" class="btn btn-secondary" >Download Video</button>&nbsp;
                            <center><input style="margin-top: 45px"  type="checkbox" class="radio" value="1" name="fooby[1][]" />  Winner</label></center>
                            @include('alerts.feedback', ['field' => 'start_at'])
                        </div>

                        <div class="form-group{{ $errors->has('end_at') ? ' has-danger' : '' }}">
                            <label>{{ __('Team 2') }}</label>
                            <button type="button" class="btn btn-secondary" >Download Photo</button><button type="button" class="btn btn-secondary" >Download Video</button>&nbsp;
                            <center><input style="margin-top: 5px" type="checkbox" class="radio" value="1" name="fooby[1][]" />  Winner</label></center>
                            @include('alerts.feedback', ['field' => 'end_at'])
                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="" class="btn btn-primary">Submit Result</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
