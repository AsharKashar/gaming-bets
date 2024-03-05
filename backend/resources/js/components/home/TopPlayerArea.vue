<template>
  <!--top of month area--->
  <section class="featured-game2">
    <section class="activities">
      <div class="funfact">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-sm-6 head-top-player-area">
              <h2
                class="top-title"
                style=""
              >
                Top of the month
              </h2>
            </div>
            <div class="col-lg-6 col-sm-6">
              <p class="top-paragraf">
                In publishing and graphic design, Lorem ipsum is a placeholder text
                commonly used to demonstrate the visual form of a document or a typeface without relying on
                meaningful content.
              </p>
            </div>

            <div class="row top-card-row">
              <div class="single-fun col-lg-4 col-sm-4">
                <div class="top-player-card">
                  <img
                    style="width:85%"
                    src="assets/images/Content-coder/characters/pony.gif"
                    alt=""
                  >
                  <div class="count-area">
                    <div class="count">
                      2nd
                    </div>
                  </div>
                  <p>
                    <!-- {{$ladder2&&$ladder2->user?$ladder2->user->name:'N/A'}} -->
                  </p>
                </div>
              </div>


              <div class="single-fun col-lg-4 col-sm-4">
                <div class="top-player-card">
                  <img
                    style="width:85%"
                    src="assets/images/Content-coder/characters/bow_1.gif"
                    alt=""
                  >
                  <div class="count-area">
                    <div class="count">
                      1st
                    </div>
                  </div>
                  <p>
                    <!-- {{$ladder1&&$ladder1->user?$ladder1->user->name:'N/A'}} -->
                  </p>
                </div>
              </div>


              <div class="single-fun col-lg-4 col-sm-4">
                <div class="top-player-card">
                  <img
                    style="width:85%"
                    src="assets/images/Content-coder/characters/floss_1.gif"
                    alt=""
                  >
                  <div class="count-area">
                    <div class="count">
                      3rd
                    </div>
                  </div>
                  <p>
                    <!-- {{$ladder3&&$ladder3->user?$ladder3->user->name:'N/A'}} -->
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="container">
      <div class="row">
        <h4 class="page-timer">
          23:04:14
        </h4>
      </div>
      <div class="row">
        <h4 class="timer-tag">
          <span class="space1">HRS</span><span class="space1">MIN</span><span
            class="space1"
          >SEC</span>
        </h4>
      </div>
    </div>
    <div class="container index-timer">
      <ul>
        <li
          class="timer-inner"
          style=" "
        >
          <span
            id="days"
            class="inner-span"
          >:</span>days
        </li>
        <li
          class="timer-inner"
          style=" "
        >
          <span
            id="hours"
            class="inner-span"
          >:</span>Hours
        </li>
        <li
          class="timer-inner"
          style=" "
        >
          <span
            id="minutes"
            class="inner-span"
          >:</span>Minutes
        </li>
      </ul>
    </div>
    <section class="get-games">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <div class="circle-section text-center">
              <img
                src="assets/images/Content-coder/red.png"
                alt=""
              >
              <h4 class="get-text">
                FREE GAMES
              </h4>
            </div>
          </div>
          <div class="col-lg-4 col-sm-4 text-center">
            <div class="circle-section text-center">
              <img
                src="assets/images/Content-coder/blue.png"
                alt=""
              >
              <h4 class="get-text">
                GLOBAL LEADERBOARDS
              </h4>
            </div>
          </div>
          <div class="col-lg-4 col-sm-4">
            <div class="circle-section text-center">
              <img
                src="assets/images/Content-coder/green.png"
                alt=""
              >
              <h4 class="get-text">
                EASY FAST CASH PAYOUTS
              </h4>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--top of month area end--->
  </section>
</template>
