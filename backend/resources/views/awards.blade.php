@extends('layout.indexlayout')
@push('css')
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap-datepicker.min.css")}}">
@endpush
@section('content')

    <div class="conatiner bomb-area">
        <div class="container bomb-cards-area">
            <div class="row" style="margin-bottom:90px">
                <div class="col-lg-6 col-sm-6"><h4 class="news-heading">Select your best choice</h4></div>
                <div class="col-lg-6 col-sm-6"><p class="news-p">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.</p>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <div class="bomb-card">
                        <h4 class="card-top-area text-center">10 bombs</h4>
                        <ul class="bomb-card-list-details ">
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Enter cash prize tournaments</li>
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Purchase from our live store</li>
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Exchange bombs into your &nbsp;preferred currency (no extra free</li>
                       </ul>
                       <img class="bomb-card-img" src="assets/images/Content-coder/Small-Group-2000.png" alt="">
                       <div class="bottom-button"><button onclick="setDetails(100,0,10)" class="btn wagerbtn" data-toggle="modal" data-target="#payment">buy &euro;10</button></div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 "><div class="bomb-card">
                        <h4 class="card-top-area text-center">50 bombs</h4>
                        <ul class="bomb-card-list-details">
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Enter cash prize tournaments</li>
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Purchase from our live store</li>
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Exchange bombs into your &nbsp;preferred currency (no extra free</li>
                       </ul>
                       <img class="bomb-card-img" src="assets/images/Content-coder/Small-Group-2000.png" alt="">
                       <div class="bottom-button"><button onclick="setDetails(590,1,50)" class="btn wagerbtn" data-toggle="modal" data-target="#payment">buy &euro;50</button></div>
                    </div></div>
                <div class="col-lg-4 col-sm-4"><div class="bomb-card">
                        <h4 class="card-top-area text-center">100 bombs</h4>
                        <ul class="bomb-card-list-details">
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Enter cash prize tournaments</li>
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Purchase from our live store</li>
                               <li class="lis "><i style="color:#bf1438" class="far fa-circle fa-xs"></i> Exchange bombs into your &nbsp;preferred currency (no extra free</li>
                       </ul>
                       <img class="bomb-card-img" src="assets/images/Content-coder/Medium-Group-2000px.png" alt="">
                       <div class="bottom-button"><button onclick="setDetails(1150,1,100)" class="btn wagerbtn" data-toggle="modal" data-target="#payment">buy &euro;100</button></div>
                    </div></div>
            </div>
            <br><br><br>
            <div class="row justify-content-md-center">
                <div class="col-lg-4 col-sm-4"><div class="bomb-card" style="border:7px solid #a1afd3;">
                        <h4 class="card-top-area text-center" style="color:#a1afd3;">500 bombs</h4>
                        <ul class="bomb-card-list-details">
                               <li class="lis "><i style="color:#a1afd3" class="far fa-circle fa-xs"></i> Enter cash prize tournaments</li>
                               <li class="lis "><i style="color:#a1afd3" class="far fa-circle fa-xs"></i> Purchase from our live store</li>
                               <li class="lis "><i style="color:#a1afd3" class="far fa-circle fa-xs"></i> Exchange bombs into your &nbsp;preferred currency (no extra free</li>
                       </ul>
                       <img class="bomb-card-img" src="assets/images/Content-coder/Medium-Group-2000px.png" alt="">
                       <div class="bottom-button"><button onclick="setDetails(500,2,500)" class="btn bombcard-btn" data-toggle="modal" data-target="#payment">buy &euro;500</button></div>
                    </div></div>
                <div class="col-lg-4 col-sm-4"><div class="bomb-card" style="border:7px solid #a1afd3;">
                        <h4 class="card-top-area text-center" style="color:#a1afd3;">1K bombs</h4>
                        <ul class="bomb-card-list-details">
                               <li class="lis "><i style="color:#a1afd3" class="far fa-circle fa-xs"></i> Enter cash prize tournaments</li>
                               <li class="lis "><i style="color:#a1afd3" class="far fa-circle fa-xs"></i> Purchase from our live store</li>
                               <li class="lis "><i style="color:#a1afd3" class="far fa-circle fa-xs"></i> Exchange bombs into your &nbsp;preferred currency (no extra free</li>
                       </ul>
                       <img class="bomb-card-img" src="assets/images/Content-coder/Larg-Group-2000px.png" alt="">
                       <div  class="bottom-button"><button onclick="setDetails(1000,4,1000)" class="btn bombcard-btn" data-toggle="modal" data-target="#payment">buy &euro;1000</button></div>
                    </div></div>

            </div>
        </div>
    </div>
    <!-- Recent Winners Area Start -->
    <!--<section class="recent-winners">
           <div class="container-fluid">
               <div class="row justify-content-around">
                   <div class="col-lg-5 col-md-10 mt-5 ml-5">
                       <div class="section-heading">
                           <h5 class="subtitle">
                               Try to Check out our
                           </h5>
                           <h2 class="title">
                               Current Bomb Credits
                           </h2>
                           <p class="text">
                               We update our site regularly; more and more winners are added every day! To locate the most recent winner's information
                           </p>
                       </div>
                   </div>
                   <div class="col-lg-3 mt-5 mr-5">
                       <div class="single-winer">
                           <div class="top-area">
                               <div class="left">
                                   <h4 class="name">
                                       Sunny
                                   </h4>
                                   <p class="date">
                                       $ 12.00
                                   </p>
                               </div>
                               <div class="right">
                                   <p class="id">#5747e75482</p>
                               </div>
                           </div>
                           <div class="bottom-area">
                               <div class="left">
                                   10000 Bomb
                               </div>
                               <div class="right">
                                   <img src="assets/images/icon2.png" alt="">
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3">
                       <div class="single-process">
                           <img src="assets/images/affiliate/ps2.png" alt="">
                           <div class="single-winer">
                           <div class="top-area">
                               <div class="left">
                                   <h4 class="name">
                                       Sunny
                                   </h4>
                                   <p class="date">
                                       $ 12.00
                                   </p>
                               </div>
                               <div class="right">
                                   <p class="id">#5747e75482</p>
                               </div>
                           </div>
                           <div class="bottom-area">
                               <div class="left">
                                   10000 Bomb
                               </div>

                           </div>
                       </div>
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
                                       Sunny
                                   </h4>
                                   <p class="date">
                                       $ 12.00
                                   </p>
                               </div>
                               <div class="right">
                                   <p class="id">#5747e75482</p>
                               </div>
                           </div>
                           <div class="bottom-area">
                               <div class="left">
                                   10000 Bomb
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
    <!-- Recent Winners Area End -->

    <!-- Awards Area Start -->
    <!--<section class="awards-area">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-heading">
                        <h5 class="subtitle">
                            Welcome Banger Games
                        </h5>
                        <h2 class="title">
                            Bomb Credits
                        </h2>
                        <p class="text">
                            We update our site regularly; more and more winners are added every day! To locate the most recent winner's information
                        </p>
                    </div>
                </div>
            </div>
            <div>

                <div class="row" >
                    <div class="col-lg-4 col-md-6">
                        <div class="single-awards" style="background-image: url('/assets/images/awards/pkg5.jpg');

                        background-repeat: no-repeat; object-fit: none;">

                            <div class="content" style="height:400px;width:200px">




                                <a href="#" class="mybtn2">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <div class="single-awards" style="background-image: url('/assets/images/awards/pkg4.jpg');

                    background-repeat: no-repeat; object-fit: none;">

                            <div class="content" style="height:400px;width:200px">

                                <a href="#" class="mybtn2">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <div class="single-awards1" style="background-image: url('/assets/images/awards/pkg2.jpg');

                    background-repeat: no-repeat; object-fit: none;">

                            <div class="content" style="height:400px;width:200px">
                                <a href="#" class="mybtn2">Purchase</a>
                            </div>
                        </div>

                    </div>



                </div>

                <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-awards" style="background-image: url('/assets/images/awards/pkg3.jpg');

                    background-repeat: no-repeat; object-fit: none;">

                            <div class="content" style="height:400px;width:200px">

                                <a href="#" class="mybtn2">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <div class="single-awards" style="background-image: url('/assets/images/awards/pkg1.jpg');

                    background-repeat: no-repeat; object-fit: none;">

                            <div class="content" style="height:500px;width:200px">

                                <a href="#" class="mybtn2">Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left:10px">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single-awards" style="background-image: url('/assets/images/awards/1st-copy.png'); background-repeat: no-repeat; object-fit: none;">

                                    <div class="content" style="height:400px;width:200px">

                                        <a onclick="setDetails(100,0,10)" data-toggle="modal" data-target="#payment" class="mybtn2"><img src="/assets/images/awards/cart.png" alt="" style="margin-bottom:2px"> &nbsp;10 EURO</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single-awards" style="background-image: url('/assets/images/awards/2nd.png'); background-repeat: no-repeat; object-fit: none;">

                                    <div class="content" style="height:400px;width:200px">

                                        <a onclick="setDetails(590,1,50)" data-toggle="modal" data-target="#payment" class="mybtn2"><img src="/assets/images/awards/cart.png" style="margin-bottom:2px" alt=""> &nbsp;50 EURO</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single-awards" style="background-image: url('/assets/images/awards/3rd.png'); background-repeat: no-repeat; object-fit: none;">

                                    <div class="content" style="height:400px;width:200px">

                                        <a onclick="setDetails(1150,1,100)" data-toggle="modal" data-target="#payment" class="mybtn2"><img src="/assets/images/awards/cart.png" style="margin-bottom:2px" alt=""> &nbsp;100 EURO</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single-awards" style="background-image: url('/assets/images/awards/4th.png'); background-repeat: no-repeat; object-fit: none;">

                                    <div class="content" style="height:500px;width:200px">

                                        <a onclick="setDetails(5200,2,500)" data-toggle="modal" data-target="#payment" class="mybtn2"><img src="/assets/images/awards/cart.png" style="margin-bottom:2px" alt=""> &nbsp;500 EURO</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single-awards1" style="background-image: url('/assets/images/awards/5th.png'); background-repeat: no-repeat; object-fit: none;margin-top:200px">

                                    <div class="content" style="height:400px;width:200px">
                                        <a onclick="setDetails(10400,4,1000)" data-toggle="modal" data-target="#payment" class="mybtn2"> <img src="/assets/images/awards/cart.png" style="margin-bottom:2px" alt=""> &nbsp;1000 EURO</a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6"><img style="max-width:300px;margin-top:400px" src="assets/images/awards/1.png" alt=""></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>-->
    <!-- Awards Area End -->

    <!-- community and Blog Area Start -->
    <!--<div class="community-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-box">
                        <div class="img">
                            <img src="assets/images/team/community-icon.png" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="#">Community <i class="fas fa-arrow-right"></i></a>
                            </h4>
                            <p class="text">
                                Find answers, support, and
                                inspiration from other Jeugo users.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-box">
                        <div class="img">
                            <img src="assets/images/team/blog-icon.png" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="#">Blogs <i class="fas fa-arrow-right"></i></a>
                            </h4>
                            <p class="text">
                                Find answers, support, and
                                inspiration from other Jeugo users.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- community and Blog Area End -->
    @include('strip.award-payment')

@endsection







@push('js')
    <script src="{{asset("assets/js/bootstrap-datepicker.min.js")}}"></script>
    <script>
        $("#card-expiry-month").datepicker({
            format: "mm",
            startView: 1,
            minViewMode: 1,
            maxViewMode: 1
        });
        $("#card-expiry-year").datepicker({
            format: "yyyy",
            startView: 2,
            minViewMode: 2,
            maxViewMode: 3,
        });

        var setDetails = function (bomb, tournaments, cost) {
            $("#bomb").val(bomb);
            $("#allowed_tournaments").val(tournaments);
            $("#cost").val(cost);
            $("#price").html(cost);
        }
    </script>
@endpush
