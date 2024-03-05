




@extends('layout.indexlayout')

@section('content')

    <!-- Breadcrumb Area Start -->
    <section class="membership-top-area">

    </section>
    <!-- Breadcrumb Area End -->

    <!-- Play Games Area Start -->
    <section class="play-games">

        <div class="all-games">
            <div class="container">
                <div class="row parent">

                    <div class="col-lg-4 col-md-6">
                        <div class="membership-card" id="c1">
                            <div class="content">
                                <div class="top">
                                    95<i class="fas fa-euro-sign fa-sm"></i>/month
                                </div>
                                <!--<img src="assets/images/awards/ic3.png" alt="">-->
                                <h4 class="title">
                                    NOVICE
                                </h4>

                                <button id="novice" class="mybtn2">MORE INFO</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="membership-card" id="c2">
                            <div class="content">
                                <div class="top">
                                    179<i class="fas fa-euro-sign fa-sm"></i>/month
                                </div>
                                <h4 class="title">
                                    ELITE
                                </h4>

                                <button id="elite" class="mybtn2">MORE INFO</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="membership-card2" id="c3">
                            <div class="content">
                                <div class="top">
                                    239<i class="fas fa-euro-sign fa-sm"></i>/month
                                </div>
                                <h4 class="title">
                                    GOD
                                </h4>

                                <button id="god" class="mybtn3">MORE INFO</button>
                            </div>
                        </div>
                    </div>


                        <!--<div class="col-lg-6 col-md-6" >
                            <div class="single-game" style="width:100%;height: 800px">
                                <h4 class="title" style="font-size: 42px;margin-top:20px">
                                    MEMBERSHIP
                                    </h4>
                                <p class="text text-left " style="font-size: 16px;margin-left:30px">
                                    If like us you want to play every day, then becoming a member can help you save money and give you the most opportunities of winning, up to 35 chances every month!
                                </p>
                                <p class="text text-left " style="font-size: 16px;margin-left:30px">
                                    We have three levels of membership to suit your needs. Choose from Novice, Elite or God!
                                </p>
                                <h4 class="title text-left" style="margin-left: 10px">
                                    Novice
                                    </h4>
                                    <p class="text text-left " style="font-size: 14px;margin-left:30px">
                                        95 Euros per month, a saving of 25 Euros if you were to pay for the same tournaments individually.
                                    </p>
                                    <h4 class="title text-left" style="margin-left: 10px">
                                        What you get:
                                        </h4>
                                        <p class="text text-left " style="font-size: 14px;margin-left:3ch">
                                            <i class="fa fa-check" aria-hidden="true"></i> Access to one, 200 Euro prize tournament every day. Non-member entry fee2.50 Euros per play
                                        </p>
                                        <p class="text text-left " style="font-size: 14px;margin-left:30px">
                                            <i class="fa fa-check" aria-hidden="true"></i> Access to one, 1,500 Euro prize tournament three times or more each month. Non-member entry fee 10.00 Euros per play.
                                        </p>
                                        <p class="text text-left " style="font-size: 14px;margin-left:30px">
                                            <i class="fa fa-check" aria-hidden="true"></i>  Access to one, 6,000 Euro prize tournament once a month. Non-member entry fee 10.00 Euros per plays
                                        </p>
                                        <h4 class="title text-left" style="margin-left: 10px">
                                            Plus:
                                            </h4>
                                            <p class="text text-left " style="font-size: 14px;margin-left:30px">
                                                <i class="fas fa-circle"></i> 25 wagers per month
                                            </p>
                                            <p class="text text-left " style="font-size: 14px;margin-left:30px">
                                                <i class="fas fa-circle"></i> Free Twitch subscription
                                            </p>
                                            <p class="text text-left " style="font-size: 14px;margin-left:30px">
                                                <i class="fas fa-circle"></i> The latest updates on our members’ exclusive offers, discounts and new services
                                            </p>

                                <a href="#" class="mybtn2">I’M IN!</a>
                            </div>
                        </div>-->


                    </div>
                </div>
                <div class="container">
                <div class="col-lg-12 col-md-12" >
                    <div class="membership-card-details" id="novicedetails">

                        <div class="row">
                            <div class="col-lg-6"><div class="left-text">Money saved</div></div>
                            <div class="col-lg-6"><div class="right-text">Save 25<i class="fas fa-euro-sign fa-sm"></i> if you were to pay daily</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Chances to win money</div></div>
                            <div class="col-lg-6"><div class="right-text">35 chances every month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Daily Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 2.5<i class="fas fa-euro-sign fa-sm"></i> entrance daily tournament per day with cash rewards of 200<i class="fas fa-euro-sign fa-sm"></i> everyday</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Weekly Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 10<i class="fas fa-euro-sign fa-sm"></i> weekly tournament per week with cash rewards of 1,500<i class="fas fa-euro-sign fa-sm"></i> 3 weeks a month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Monthly Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 10<i class="fas fa-euro-sign fa-sm"></i> monthly tournament per month with cash rewards of 6,000<i class="fas fa-euro-sign fa-sm"></i> per month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Wagers</div></div>
                            <div class="col-lg-6"><div class="right-text">25/month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Twitch subscription</div></div>
                            <div class="col-lg-6"><div class="right-text">FREE</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Exclusive offers</div></div>
                            <div class="col-lg-6"><div class="right-text">Later updates on our members exclusive offers, discount and new service</div></div>
                            <br><br>
                            @if(Auth::check())
                                @if(!(auth()->user()->subscibe_qty))
                                    <div class="col-lg-12"><button id="novice" onclick="noviceFunction()" class="mybtn1" >GET THIS NOW</button></div>
                                @endif
                            @endif
                        </div>


                    </div>
                    <div class="membership-card-details" id="elitedetails">

                        <div class="row">
                            <div class="col-lg-6"><div class="left-text">Money saved</div></div>
                            <div class="col-lg-6"><div class="right-text">Save 36<i class="fas fa-euro-sign fa-sm"></i> if you were to pay daily</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Chances to win money</div></div>
                            <div class="col-lg-6"><div class="right-text">35 chances every month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Daily Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 5<i class="fas fa-euro-sign fa-sm"></i> entrance daily tournament per day with cash rewards of 300<i class="fas fa-euro-sign fa-sm"></i> everyday</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Weekly Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 15<i class="fas fa-euro-sign fa-sm"></i> weekly tournament per week with cash rewards of 2,000<i class="fas fa-euro-sign fa-sm"></i> 3 weeks a month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Monthly Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 15<i class="fas fa-euro-sign fa-sm"></i> monthly tournament per month with cash rewards of 8,500<i class="fas fa-euro-sign fa-sm"></i> per month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Wagers</div></div>
                            <div class="col-lg-6"><div class="right-text">60/month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Twitch subscription</div></div>
                            <div class="col-lg-6"><div class="right-text">FREE</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Exclusive offers</div></div>
                            <div class="col-lg-6"><div class="right-text">Later updates on our members exclusive offers, discount and new service</div></div>
                            <br><br>
                            @if(Auth::check())
                                @if(!(auth()->user()->subscibe_qty))
                                    <div class="col-lg-12"><button id="elite" onclick="eliteFunction()" class="mybtn1" >GET THIS NOW</button></div>
                                @endif
                            @endif
                        </div>


                    </div>
                    <div class="membership-card-details" id="goddetails">

                        <div class="row">
                            <div class="col-lg-6"><div class="left-text">Money saved</div></div>
                            <div class="col-lg-6"><div class="right-text">Save 74<i class="fas fa-euro-sign fa-sm"></i> if you were to pay daily</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Chances to win money</div></div>
                            <div class="col-lg-6"><div class="right-text">35 chances every month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Daily Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 7.5<i class="fas fa-euro-sign fa-sm"></i> entrance daily tournament per day with cash rewards of 500<i class="fas fa-euro-sign fa-sm"></i> everyday</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Weekly Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 20<i class="fas fa-euro-sign fa-sm"></i> weekly tournament per week with cash rewards of 2,000<i class="fas fa-euro-sign fa-sm"></i> 3 weeks a month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Monthly Tournaments</div></div>
                            <div class="col-lg-6"><div class="right-text">Access to one 20<i class="fas fa-euro-sign fa-sm"></i> monthly tournament per month with cash rewards of 10,000<i class="fas fa-euro-sign fa-sm"></i> per month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Wagers</div></div>
                            <div class="col-lg-6"><div class="right-text">Unlimited/month</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Twitch subscription</div></div>
                            <div class="col-lg-6"><div class="right-text">FREE</div></div>
                            <hr>
                            <div class="col-lg-6"><div class="left-text">Exclusive offers</div></div>
                            <div class="col-lg-6"><div class="right-text">Later updates on our members exclusive offers, discount and new service</div></div>
                            <br><br>
                            @if(Auth::check())
                                @if(!(auth()->user()->subscibe_qty))
                                    <div class="col-lg-12"><button id="god" onclick="godFunction()" class="mybtn1" >GET THIS NOW</button></div>
                                @endif
                            @endif
                        </div>


                    </div>
                </div>
                </div>
            </div>

        </div>

    </section>
    <!-- Play Games Area End -->
<script>
var subs={};

subs['plan']='plan_H6I3JfBRpPzsT8';
@if(Auth::check())
    subs['id']="<?php echo auth()->user()->stripe_id; ?>";
@endif
function noviceFunction(){
    console.log('novice');
    $("#card_details").css("display", "block");
    $("#card_details").addClass('show');
    subs['quantity']=5;
    console.log(subs);

}
function eliteFunction(){
    console.log('elite');
    $("#card_details").css("display", "block");
    $("#card_details").addClass('show');
    subs['quantity']=10;
    console.log(subs);

}
function godFunction(){
    console.log('god');
    $("#card_details").css("display", "block");
    $("#card_details").addClass('show');
    subs['quantity']=15;
    console.log(subs);

}
function closeCardDetails(){
    $("#card_details").css("display", "none");
    $("#card_details").removeClass('show');
    console.log('close');
}
</script>

@endsection







