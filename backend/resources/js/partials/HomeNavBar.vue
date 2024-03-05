<template>
  <header class="header">
    <section class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="content">
              <div class="left-content">
                <ul class="left-list" />
              </div>
              <div class="right-content">
                <ul class="right-list">
                  <li>
                    <div class="cart-icon tm-dropdown">
                      <a
                        href="/awards"
                        class=""
                      ><img
                        src="/assets/images/awards/cart.png"
                        alt=""
                        style="margin-bottom:2px"
                      >	&nbsp;Buy</a>	&nbsp; / 	&nbsp;
                      <a
                        href="/cash-withdrawal"
                        class="link-btn"
                      ><img
                        style="width:20px;"
                        src="assets/images/bomb@2x.png"
                        alt=""
                      >	0 Bomb</a>
                    </div>
                  </li>

                  <li>
                    <a
                      href="#"
                      class="sign-in"
                      data-toggle="modal"
                      data-target="#login"
                    >
                      <i class="fas fa-user" /> Sign In
                    </a>
                  </li>

                  <!-- <li>
                                            <a href="javascript: $('#logout').submit();" class="sign-in" >
                                                <i class="fas fa-user-lock"></i> Log Out
                                            </a>
                                        </li> -->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <nav
      role="navigation"
      class="mobile-nav"
      style="margin-left:30px"
    >
      <a
        id="toggle"
        href="#"
        style="width:300px"
      ><i
        style="color:#bf1438"
        class="fas fa-bars fa-lg"
      /><img
        style="width:60%;margin-left:10%"
        src="assets/images/bangers-logo.png"
        alt=""
      ></a>
      <ul class="mobile-ul">
        <li>
          <a
            href="/index"
            class="mobile-nav-list"
          >Home</a>
        </li>
        <li>
          <a
            href="/cart"
            class="mobile-nav-list"
          >Sponsors</a>
        </li>
        <li>
          <a
            href="/leaderboards"
            class="mobile-nav-list"
          >Leaderboards</a>
        </li>
        <li>
          <a
            href="/about"
            class="mobile-nav-list"
          >About</a>
        </li>
        <li>
          <a
            id="games"
            href="#"
            class="mobile-nav-list"
          >Game</a>
        </li>

        <li>
          <a
            href="/awards"
            class="mobile-nav-list"
          >Bomb Coins</a>
        </li>
        <li>
          <a
            href="/membership"
            class="mobile-nav-list"
          >Membership</a>
        </li>
        <li>
          <a
            href="/profile"
            class="mobile-nav-list"
          >Profile</a>
        </li>
      </ul>
    </nav>
    <div class="mainmenu-area">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <div class="row">
              <div class="col-lg-3 col-sm-3">
                <a
                  class="navbar-brand"
                  href="/index"
                >
                  <img
                    class="site-logo"
                    alt=""
                  >
                </a>
              </div>
              <div class="col-lg-2 col-sm-2">
                <ul class="navbar-nav1">
                  <li class="nav-item active">
                    <a
                      class="nav-link"
                      href="/index"
                    >Home

                    </a>
                    <a
                      style="margin-top:-20px"
                      class="nav-link"
                      href="/cart"
                    >Sponsors</a>
                    <a
                      style="margin-top:-20px"
                      class="nav-link"
                      href="/leaderboards"
                    >Leaderboards

                    </a>
                    <a
                      style="margin-top:-20px"
                      class="nav-link"
                      href="/about"
                    >About

                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-2 col-sm-2">
                <ul class="navbar-nav1">
                  <li class="nav-item">
                    <a
                      id="game"
                      class="nav-link "
                      style="cursor: pointer;"
                    >Game

                    </a>
                    <a
                      style="margin-top:-20px"
                      class="nav-link"
                      href="/awards"
                    >Bomb Coins

                    </a>
                    <a
                      style="margin-top:-20px"
                      class="nav-link"
                      href="/membership"
                    >Membership</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-2 col-sm-2">
                <ul
                  id="gameslist"
                  class="navbar-nav1"
                />
              </div>
              <div class="col-lg-3 col-sm-3">
                <div class="topbtn" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>

</script>

<style>
</style>
