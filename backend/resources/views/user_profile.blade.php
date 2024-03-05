@extends('layout.mainlayout')

@section('content')
    <style>
        .faq-wrapper .nav-link {
            font-size: 15px !important;
        }
    </style>
    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area bc-tournaments">
        <img class="bc-img" src="assets/images/contact-left.png" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="title">
                        User dashboard
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
                            <a href="/user_dashboard">user Dashboard</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!--<section class="dashboard">
        <div class="info-table">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <div class="row">
                                <div class="col-lg-4 side_bar"></div>
                                <div class="col-lg-8 main_menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>-->
    <!-- faq-section start -->
    <section class="faq-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-heading">
                        <!--<h5 class="subtitle">
                            Fortnite
                        </h5>-->
                        <!--<small>{{$user->total_points}} points </small>-->
                        <h2 class="title">
                            Dashboard
                        </h2>
                        <p class="text">
                        Welcome to Your dashboard. Here you can customise your profile, view current and previous tournaments, edit payment options and withdraw earnings through your preferred methods.
                        </p>
                    </div>
                </div>
            </div>
                           	<!-- dashboard head Area Start -->
	<footer class="footer" id="footer" style="padding-top:0px">
			<div class="subscribe-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="subscribe-boxe" >
									<form action="#">
								<div class="row justify-content-between">
									<div class="col-lg-12">

										<!--<div class="heading-area">
												<h5 class="sub-title">
														subscribe to Dooplo
												</h5>
												<h4 class="title">
														To Get Exclusive Benefits
												</h4>
										</div>-->
									</div>
									<!--<div class="col-lg-3 col-4 d-flex align-self-center">
										<div class="icon">
											<img src="assets/images/mail-box.png" alt="">
										</div>
									</div>
									<div class="col-lg-6 col-8 d-flex align-self-center">
										<div class="form-area">
												<input type="text" placeholder="Your Email Address">
										</div>
									</div>-->
									<div class="col-lg-4 d-flex align-self-center">




                            <div class="top-area">
                                <img   style="width:100px;height:100px;margin-left:35%;border-radius:50px;margin-top:10px"  src="{{url('/storage/'.$user->image)}}" onerror="this.onerror=null; this.src='assets/images/affiliate/ps1.png'" class="img-thumbnail" alt="Profile Picture">

                            <div class="left">

                                <h4 class="name" style="padding-top:10px;padding-left:45px">
                                        {{$user->name}}
                                </h4>

                            </div>

                            </div>
                            <div class="bottom-area">
                                <div class="left">

                                </div>

                            </div>

                                       	<!-- Affiliate Process area Start -->
										<!--<div class="button-area">
											<button class="mybtn1" type="submit">Subscribe
												<span><i class="fas fa-paper-plane"></i></span>
											</button>
										</div>-->
									</div>


                                    <p class="date">
                                    <p style="margin-top:30px;margin-left:30px"><img src="assets/images/awards/ic4.png"  style="width=20px">	&nbsp;Total Points : {{$user->total_points}}</p>

                                    </p>
                                    <p class="date" style="padding-top:30px">
                                    <p style="margin-top:30px;margin-left:30px"><img src="assets/images/awards/ic2.png"  style="width=20px">	&nbsp;Total Bomb :<i class="fas fa-coins"></i> {{$user->total_prize}}</p>

                                    </p>

								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="container">
				<div class="row">
					<div class="col-sm-6 col-lg-3">
						<div class="footer-widget info-link-widget">
							<h4 class="title">
								About
							</h4>
							<ul class="link-list">
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	About Us
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Contact Us
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Latest Blog
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Authenticity Guarantee
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Customer Reviews
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Privacy Policy

									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<div class="footer-widget info-link-widget">
							<h4 class="title">
								My Account
							</h4>
							<ul class="link-list">
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> Manage Your Account
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> How to Deposit
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> How to Withdraw
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> Account Varification
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> Safety & Security
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> Membership Level

									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<div class="footer-widget info-link-widget">
							<h4 class="title">
								help center
							</h4>
							<ul class="link-list">
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Help centre
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>FAQ
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Quick Start Guide
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Tutorials
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Borrow
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Lend

									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<div class="footer-widget info-link-widget">
							<h4 class="title">
								Legal Info
							</h4>
							<ul class="link-list">
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Risk Warnings
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Privacy Notice
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Security
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Terms of Service
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Become Affiliate
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Complaints Policy

									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>-->
			<!--<div class="copy-bg">
				<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<div class="left-area">
								<p>Copyright © 2019.All Rights Reserved By <a href="#">Dooplo</a>
								</p>
							</div>
						</div>
						<div class="col-lg-7">
							<ul class="copright-area-links">
								<li>
									<a href="#">Terms Of Use</a>
								</li>
								<li>
									<a href="#">Privacy Policy</a>
								</li>
								<li>
									<a href="#">Gamble</a>
								</li>
								<li>
									<a href="#">Aware</a>
								</li>
								<li>
									<a href="#">Help Cente</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>-->
            <p class="date">

		</footer>
	<!-- dashboard head Area End -->
            <div class="row ">

                <div class="col-lg-3">
                    <div class="faq-wrapper" >
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;" class="nav-link active" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab" aria-controls="ticket" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;"class="nav-link" id="tournaments-tab" data-toggle="tab" href="#tournaments" role="tab" aria-controls="tournaments" aria-selected="false">Matches</a>
                            </li>
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;"class="nav-link " id="results-tab" data-toggle="tab" href="#results" role="tab" aria-controls="results" aria-selected="false">Active Tournaments</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="faq-wrapper"style="background-color:#070b28;height:650px">
                        <ul class="nav nav-tas" id="myTab" role="tablist">

                        </ul><div class="col" style="background-color:#192140;border-radius:10px;width:90%;margin-left:5%;height:615px;overflow: scroll;">
                        <div class="tab-content" id="myTabContent" style="padding: 0 15px">
                            <div class="tab-pane fade active show" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                            <br>
                            <center><h3>Overview</h3></center><br>
                                <!---->
                                <!-- progress bar area-->

<div class="container">
		<div class="row">
			<div class="col-lg-6"><svg viewbox="0 0 100 100" style="text-align:center;font-family: 'Open Sans', sans-serif;">
  <circle cx="50" cy="50" r="45" fill="#1C294E"/>
  <path fill="none" stroke-linecap="round" stroke-width="5" stroke="#a1aed4"
        stroke-dasharray="125.6,125.6"
        d="M50 10
           a 40 40 0 0 1 0 80
           a 40 40 0 0 1 0 -80"/>

  <text x="50" y="50" text-anchor="middle" dy="7" font-size="20">{{$user->winning_perc}}%</text>


</svg>
<p style="margin-left:36%"> Winning rate</p>
</div>
			<div class="col-lg-6"><svg viewbox="0 0 100 100" style="text-align:center;font-family: 'Open Sans', sans-serif;">
  <circle cx="50" cy="50" r="45" fill="#1C294E"/>
  <path fill="none" stroke-linecap="round" stroke-width="5" stroke="#a1aed4"
        stroke-dasharray="251.2,10"
        d="M50 10
           a 40 40 0 0 1 0 80
           a 40 40 0 0 1 0 -80"/>
  <text x="50" y="50" text-anchor="middle" dy="7" font-size="20">{{$user->standing}}</text>



</svg>
<p style="margin-left:31%" >Current Position</p>
</div>
		</div>
	</div>

                                <!-- end  progress bar area-->
                                <!-- SignIn Area Start -->
                                <!--<div class="login-modal sign-in">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                            <!--<div class="modal-body">-->
                                                <!--<div class="logo-area">
                                                        <img class="logo" src="assets/images/logo.png" alt="">
                                                </div>-->
                                                <!--<div class="header-area">
                                                    <h4 class="title">Great to have you back!</h4>
                                                    <p class="sub-title">Enter your details below.</p>
                                                </div>
                                                <div class="form-area">
                                                    <div class="row">
                                                        <img style="height:100px !important;margin: auto;"  src="{{url('/storage/'.$user->image)}}" class="img-thumbnail" alt="Profile Picture">
                                                    </div>
                                                    <br>
                                                    <table class="table">
                                                        <tr>
                                                            <td ><p>Name</p></td>
                                                            <td><p>{{$user->name}}</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><p>Email</p></td>
                                                            <td><p>{{$user->email}}</p></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                                <div class="inner-table">
                                    @if (auth()->user()->image)
                                        <div class="row">
                                            <img src="/storage/{{auth()->user()->image}}" class="img-thumbnail" alt="Profile Picture">
                                        </div>
                                    @endif
                                    <div class="row mt-5">
                                        <form action="{{route("profile.picture")}}" enctype="multipart/form-data" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-info" type="submit">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="banking" role="tabpanel" aria-labelledby="banking-tab">
                                <div class="inner-table">
                                    <div class="responsive-table">
                                        <table class="table text-white">
                                            <thead>
                                            <tr>
                                                <th scope="col">Tournament</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($user->payments as $payment)
                                                <tr>
                                                    <td>{{$payment->name}}</td>
                                                    <td>$ {{$payment->amount}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">No payments</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>-->
                            </div>

                            <div class="tab-pane fade" id="tournaments" role="tabpanel" aria-labelledby="tournaments-tab">
                            <br>
                            <center><h3>Matches</h3></center><br>
                                <div class="inner-table">
                                    <div class="responsive-table">
                                        <table class="table text-light">
                                            <thead>
                                            <tr>
                                                <th scope="col">Tournament</th>
                                                <th scope="col">Place</th>
                                                <th scope="col">Points</th>
                                                <th scope="col">Prize</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($user->tournaments['ended']))
                                                @foreach($user->tournaments['ended'] as $tour)
                                                    <?php
                                                    $place = '--';
                                                    $point = '--';
                                                    $prize = '--';
                                                    if ($tour->first_place == $user->id) {
                                                        $place = "First";
                                                        $point = $tour->first_points;
                                                        $prize = $tour->first_prize;
                                                    } elseif ($tour->second_place == $user->id) {
                                                        $place = "Second";
                                                        $point = $tour->second_points;
                                                        $prize = $tour->second_prize;
                                                    } elseif ($tour->third_place == $user->id) {
                                                        $place = "Third";
                                                        $point = $tour->third_points;
                                                        $prize = $tour->third_prize;
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td>{{$tour->name}}</td>
                                                        <td>{{$place}}</td>
                                                        <td>{{$point}}</td>
                                                        <td>{{$prize}}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center"> No History</td>
                                                </tr>
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="winning" role="tabpanel" aria-labelledby="winning-tab">

                                <div class="accordion sorteo-accordion" id="accordionExample3">
                                    <div class="card">
                                        <div class="card-header" id="headingSeven">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven"><i
                                                        class="fa fa-question"></i> What is the meaning of business with example?
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordionExample3">
                                            <div class="card-body">
                                                <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingEight">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight"><i
                                                        class="fa fa-question"></i> What is a business simple definition?
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample3">
                                            <div class="card-body">
                                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade  " id="results" role="tabpanel" aria-labelledby="results-tab">
                            <br>
                            <center><h3>Active Tournaments</h3></center><br>
                                @if (isset($user->tournaments['started']))
                                    <section>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="gaming-activities">
                                                    <div class="gaming-activities-inner">

                                                        <div class="row">
                                                            @foreach($user->tournaments['started'] as $tournament)
                                                                <div class="col-lg-6 col-md-6 mt-5">
                                                                    <div class="single-activities"
                                                                         onclick="location.href='{{route('tournament.details',$tournament->tournament_id)}}';"
                                                                         style="cursor: pointer;">
                                                                        <div class="top-area">
                                                                            <div class="left">
                                                                                <div class="icon">
                                                                                    <img src="/storage/{{$tournament->image}}" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'" alt="">
                                                                                    {{--                                                                                                    <span>4.5 <i class="fas fa-star"></i></span>--}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="right">
                                                                                <h4 class="title">
                                                                                    {{$tournament->name}}
                                                                                </h4>
                                                                                <p class="text">
                                                                                    {{$tournament->game->name}}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="bottom-area">
                                                                            <h4 class="title">Registered:</h4>
                                                                            <div class="players-count">
                                                                                @if ($tournament->players->count() > 5)
                                                                                    <?php $remaining = $tournament->players->count() - 5;?>
                                                                                    <ul class="players-list">
                                                                                        @foreach($tournament->players->splice(0,4) as $team)
                                                                                            <li>
                                                                                                <img src="/storage/{{$team->image}}" alt="">
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                    <div class="count-num">
                                                                                        {{ "+".$remaining }}
                                                                                    </div>
                                                                                @else
                                                                                    <ul class="players-list">
                                                                                        @foreach($tournament->players as $team)
                                                                                            <li>
                                                                                                <img src="/storage/{{$team->image}}" alt="">
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </div>
                                                                            <div class="pp">
                                                                                <p>{{$tournament->players->count()}}/{{$tournament->bracket_size}} </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                @else
                                    <h5 class="w-100 text-center">No Data Found</h5>
                                @endif

                            </div>
                        </div>
                                                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq-section end -->
    <script type="text/javascript">
        $(document).ready(function(){
            var count = $(('#count'));
$({ Counter: 0 }).animate({ Counter: count.text() }, {
  duration: 5000,
  easing: 'linear',
  step: function () {
    count.text(Math.ceil(this.Counter)+ "%");
  }
});

var s = Snap('#animated');
var progress = s.select('#progress');

progress.attr({strokeDasharray: '0, 251.2'});
Snap.animate(0,251.2, function( value ) {
    progress.attr({ 'stroke-dasharray':value+',251.2'});
}, 5000);
        });
    </script>


@endsection

