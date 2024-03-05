<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="loader loader-1">

        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>
</div>
<!-- preloader area end -->
<!-- Header Area Start  -->
<header class="header">

    <!--<div id="video" class="preloader1">
    <video controls="controls" width="800" height="600"
    name="Video Name"  autoplay="true" src="/assets/images/loaderbomb.mp4"></video></div>-->
    <!--<div><video  width="400" controls Autoplay=autoplay>
        <source src="/assets/bombanimation.mov" type="video/mov">
      </video></div>-->
      <!--<div class="container">
        <div class="row">/assets/bombanimation.mov
          <div class="col-sm-12">
            <h1 class="text-center display-4 mt-5">
              Solodev Web Design & Content Management Software
            </h1>
            <p class="text-center mt-5">
              <a href="#headerPopup" style=" width:75%;
              margin:0 auto;" id="headerVideoLink" target="_blank" class="btn btn-outline-danger popup-modal">See Why Solodev WXP</a>
            </p>
            <div id="headerPopup" class="mfp-hide embed-responsive embed-responsive-21by9">

              <video class="embed-responsive-item" width="854" height="480" id="vide" style="width:100%;
              margin:0 auto;" controls Autoplay=autoplay allowfullscreen>
                <source src="/assets/images/loaderbomb.mp4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen type="video/mp4">
              </video>
            </div>
          </div>
        </div>
      </div>-->
    <!-- Top Header Area Start -->
    <section class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="left-content">
                            <ul class="left-list">
                                <!--<li>
                                    <p>
                                        <i class="fas fa-headset"></i>	Support
                                    </p>
                                </li>-->
                                <!--<li>
                                    <p>
                                    <i class="fas fa-trophy"></i>	120 Credits
                                    </p>
                                </li>
                                <li>
                                    <div class="language-selector">
                                        <select name="language" class="language">
                                            <option value="1">English</option>
                                            <option value="2">France</option>
                                            <option value="3">Japan</option>
                                        </select>
                                    </div>
                                </li>-->
                            </ul>
                        </div>
                        <div class="right-content" style="display:none">
                            <ul class="right-list">
                                 <li>
                                     <div class="cart-icon tm-dropdown">

                                         <!--<i class="fas fa-cart-arrow-down"></i>

                                         <span class="cart-count">10</span>-->
                                         <a href="/awards" class=""><img src="/assets/images/awards/cart.png" alt="" style="margin-bottom:2px">	&nbsp;Buy</a>	&nbsp; / 	&nbsp;
                                         <a href="/cash-withdrawal" class="link-btn" ><img  style="width:20px;" src="assets/images/bomb@2x.png" alt="">	&nbsp;{{auth()->user() ? auth()->user()->total_bomb() : 0}} Bomb</a>
                                         <!--<div class="tm-dropdown-menu">
                                             <ul class="list">
                                                 <li class="list-item">
                                                     <div class="close">
                                                         <i class="fas fa-times"></i>
                                                     </div>
                                                     <ul class="number-list">
                                                         <li>24</li>
                                                         <li>25</li>
                                                         <li>26</li>
                                                         <li>27</li>
                                                         <li>28</li>
                                                     </ul>
                                                 </li>
                                                 <li class="list-item">
                                                     <div class="close">
                                                         <i class="fas fa-times"></i>
                                                     </div>
                                                     <ul class="number-list">
                                                         <li>24</li>
                                                         <li>25</li>
                                                         <li>26</li>
                                                         <li>27</li>
                                                         <li>28</li>
                                                     </ul>
                                                 </li>
                                                 <li class="list-item">
                                                     <div class="close">
                                                         <i class="fas fa-times"></i>
                                                     </div>
                                                     <ul class="number-list">
                                                         <li>24</li>
                                                         <li>25</li>
                                                         <li>26</li>
                                                         <li>27</li>
                                                         <li>28</li>
                                                     </ul>
                                                 </li>
                                                 <li class="list-item">
                                                     <div class="close">
                                                         <i class="fas fa-times"></i>
                                                     </div>
                                                     <ul class="number-list">
                                                         <li>24</li>
                                                         <li>25</li>
                                                         <li>26</li>
                                                         <li>27</li>
                                                         <li>28</li>
                                                     </ul>
                                                 </li>
                                             </ul>
                                             <a href="/cart" class="link-btn">Cart Page</a>
                                         </div>-->
                                     </div>
                                 </li>
                                 <!--<li>
                                     <div class="notofication tm-dropdown">
                                         <i class="fas fa-bell"></i>
                                         <span class="count">11</span>
                                         <div class="tm-dropdown-menu">
                                             <ul class="list">
                                                 <li>
                                                     <a href="#">
                                                         <i class="fas fa-bell"></i>
                                                         Invest Exchange
                                                     </a>
                                                 </li>
                                                 <li>
                                                     <a href="#">
                                                         <i class="fas fa-bell"></i>
                                                         Invest Exchange
                                                     </a>
                                                 </li>
                                                 <li>
                                                     <a href="#">
                                                         <i class="fas fa-bell"></i>
                                                         Invest Exchange
                                                     </a>
                                                 </li>
                                                 <li>
                                                     <a href="#">
                                                         <i class="fas fa-bell"></i>
                                                         Invest Exchange
                                                     </a>
                                                 </li>
                                                 <li>
                                                     <a href="#">
                                                         <i class="fas fa-bell"></i>
                                                         Invest Exchange
                                                     </a>
                                                 </li>
                                             </ul>
                                         </div>
                                     </div>
                                 </li>-->
                                @guest
                                    <li>
                                        <a href="#" class="sign-in" data-toggle="modal" data-target="#login">
                                            <i class="fas fa-user"></i> Sign In
                                        </a>
                                    </li>
                                @endguest
                                @auth
                                    <li>
                                        <a href="javascript: $('#logout').submit();" class="sign-in" >
                                            <i class="fas fa-user-lock"></i> Log Out
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    @auth
        <form id="logout" method="post" action="{{route("logout")}}" style="display: none">
            @csrf
        </form>
    @endauth
    <!-- Top Header Area End -->
    <nav role='navigation' class="mobile-nav" style="margin-left:30px">
    <a href="#" id="toggle" style="width:300px"><i style="color:#bf1438" class="fas fa-bars fa-lg"></i><img style="width:60%;margin-left:10%" src="assets/images/bangers-logo.png"  alt="" ></a>
  <ul class="mobile-ul">
    <li><a href="/index" class="mobile-nav-list">Home</a></li>
    <li><a href="/cart" class="mobile-nav-list">Sponsors</a></li>
    <li><a href="/leaderboards" class="mobile-nav-list">Leaderboards</a></li>
    <li><a href="/about" class="mobile-nav-list">About</a></li>
    <li><a href="#" class="mobile-nav-list" id="games">Game</a></li>
        @foreach(\App\Game::all() as $game)
    <li id="game-name">
    <a class="mobile-nav-list" href="{{route("game.tournaments",$game->id)}}">{{$game->name}}</a></li>
        @endforeach
    <li><a href="/awards" class="mobile-nav-list">Bomb Coins</a></li>
    <li><a href="/membership" class="mobile-nav-list">Membership</a></li>
    @auth()
    <li><a href="/profile" class="mobile-nav-list">Profile</a></li>
    @endauth
  </ul>
</nav>
    <!--Main-Menu Area Start-->
    <div class="mainmenu-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                <div class="row">
                            <div class="col-lg-3 col-sm-3">
                            <a class="navbar-brand" href="/index">
                            <img class="site-logo"  alt="" >
                        </a>
                            </div>
                            <div class="col-lg-2 col-sm-2">
                                <ul class="navbar-nav1">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/index">Home

                                    </a>
                                    <a style="margin-top:-20px" class="nav-link" href="/cart">Sponsors</a>
                                    <a style="margin-top:-20px" class="nav-link" href="/leaderboards">Leaderboards

                                        </a>
                                        <a style="margin-top:-20px" class="nav-link" href="/about">About

                                    </a>
                                </li>
                            </ul>
                        </div>
                            <div class="col-lg-2 col-sm-2">
                            <ul class="navbar-nav1">
                            <li class="nav-item">

                                    <a class="nav-link" id="Game-1" style="cursor: pointer;">Game

                                    </a>
                                    <a style="margin-top:-20px" class="nav-link" href="/awards">Bomb Coins

                                    </a>
                                    <a style="margin-top:-20px" class="nav-link" href="/membership">Membership</a>
                                    @auth()
                                        <a style="margin-top:-20px" class="nav-link" href="/profile">Profile</a>
                                    @endauth
                                </li>
                                </ul>
                            </div>
                            <div class="col-lg-2 col-sm-2">
                            <ul class="navbar-nav1" id="gameslist-1">

                                        @foreach(\App\Game::all() as $game)
                                        <li style="margin-top:8px;height:15px" class="nav-item">
                                        <a  class="nav-link1" href="{{route("game.tournaments",$game->id)}}">{{$game->name}}</a>
                                        </li> @endforeach

                                    </ul>
                            </div>
                            <div class="col-lg-3 col-sm-3">
                                <div class="topbtn">
                            @guest
                                <a href="#" class="mybtn4" data-toggle="modal" data-target="#login"> sign in</a>
                            @endguest
                            @auth()
                                <a href="{{route("profile")}}" class="mybtn4" > {{auth()->user()->name}}</a>
                            @endauth
                            </div>
                            </div>
                        </div>

                    <!--<nav class="navbar">



                        <a class="navbar-brand" href="/index">
                            <img class="site-logo"  alt="" >
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse fixed-height" id="main_menu">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/index">Home

                                    </a>
                                    <a class="nav-link" href="/cart">Sponsors</a>
                                    <a class="nav-link" href="/leaderboards">Leaderboards

                                        </a>
                                        <a class="nav-link" href="/about">About

                                    </a>
                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="/about">Game

                                    </a>
                                    <a class="nav-link" href="/about">Bomb Coins

                                    </a>
                                    <a class="nav-link" href="/membership">Membership</a>
                                    <a class="nav-link" href="/about">Profile

                                    </a>
                                </li>
                               <li class="nav-item">
                                        <a class="nav-link" href="/leaderboards">Leaderboards
                                            <div class="mr-hover-effect"></div>
                                        </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Games
                                        <div class="mr-hover-effect"></div>
                                    </a>
                                    <ul class="dropdown-menu" >
                                        @foreach(\App\Game::all() as $game)
                                        <li><a class="dropdown-item" href="{{route("game.tournaments",$game->id)}}"> <i class="fa fa-angle-double-right"></i>{{$game->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Pages
                                        <div class="mr-hover-effect"></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/cart"> <i class="fa fa-angle-double-right"></i>Sponsors</a></li>
                                        <li><a class="dropdown-item" href="/how-it-work"> <i class="fa fa-angle-double-right"></i>How It Works</a></li>
                                        <li><a class="dropdown-item" href="/terms-conditions-details"> <i class="fa fa-angle-double-right"></i>Privacy Policy</a></li>
                                        <li><a class="dropdown-item" href="/terms-conditions"> <i class="fa fa-angle-double-right"></i>Terms & Condition</a></li>
                                        <li><a class="dropdown-item" href="/faq"> <i class="fa fa-angle-double-right"></i>Faq</a></li>
                                        <li><a class="dropdown-item" href="/membership"> <i class="fa fa-angle-double-right"></i>Membership</a></li>
                                        <li><a class="dropdown-item" href="/contact"> <i class="fa fa-angle-double-right"></i>Help</a></li>

                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://gaming.alh.ejn.mybluehost.me/shop/">Shop
                                        <div class="mr-hover-effect"></div>
                                    </a>

                                </div>
                                </li>
                            </ul>
                            <div style="margin-right:200px;margin-left:500px;margin-top:-10px">
                            @guest
                                <a href="#" class="mybtn4" data-toggle="modal" data-target="#signin"> sign in</a>
                            @endguest
                            @auth()
                                <a href="{{route("profile")}}" class="mybtn4" > {{auth()->user()->name}}</a>
                            @endauth</div>
                        </div>
                    </nav>-->
                </div>
            </div>
        </div>
    </div>
    <!--Main-Menu Area Start-->

</header>
<!-- Header Area End  -->
