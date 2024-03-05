<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        sm="2"
        class="game"
      >
        <img
          src="~/static/icons/csgo.svg"
          alt=""
        >
      </v-col>
      <v-col
        cols="12"
        sm="2"
        class="game"
      >
        <img
          src="~/static/icons/apex_legends.svg"
          alt=""
        >
      </v-col>
      <v-col
        cols="12"
        sm="2"
        class="game"
      >
        <img
          src="~/static/icons/fortnite.svg"
          alt=""
        >
      </v-col>
      <v-col
        cols="12"
        sm="2"
        class="game"
      >
        <img
          src="~/static/icons/call_of_duty.svg"
          alt=""
        >
      </v-col>
      <v-col
        cols="12"
        sm="2"
        class="game"
      >
        <img
          src="~/static/icons/valorant.svg"
          alt=""
        >
      </v-col>
    </v-row>

    <v-tabs
      background-color="transparent"
      fixed-tabs
    >
      <v-tab>
        {{ $t('Squad') }}
      </v-tab>
      <v-tab>
        {{ $t('Trio') }}
      </v-tab>
      <v-tab>
        {{ $t('Duo') }}
      </v-tab>

      <v-tab-item>
        <div class="item-head">
          <div>{{ $t('NAME') }}</div>
          <div>{{ $t('TIME START') }}</div>
          <div>{{ $t('Regestration Teams') }}</div>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>
      </v-tab-item>
      <v-tab-item>
        <div class="item-head">
          <div>{{ $t('NAME') }}</div>
          <div>{{ $t('TIME START') }}</div>
          <div>{{ $t('Regestration Teams') }}</div>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>
      </v-tab-item>
      <v-tab-item>
        <div class="item-head">
          <div>{{ $t('NAME') }}</div>
          <div>{{ $t('TIME START') }}</div>
          <div>{{ $t('Regestration Teams') }}</div>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-1">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>

        <div class="tournament game-2">
          <span class="tournament-name">Marathon Ninja Masters Pro League Multifan</span>
          <span class="tournament-time">
            00:10:00
          </span>
          <span class="registertion-teams">105</span>
        </div>
      </v-tab-item>
    </v-tabs>
  </v-container>
</template>

<script>
export default {
  name: 'TournamentGames'
};
</script>

<style scoped lang="scss">
.game{
    margin-left:30px;
}
.v-tabs-items,.v-data-table {
    background-color: transparent !important;
}
.game-1{
    background-image: url("~/static/images/tournament-game-bg.png");
}
.game-2{
    background-image: url("~/static/images/tournament-game-bg-2.png");
}
.item-head{
    display: flex;
    flex-wrap: nowrap;
    flex-direction:row;
    justify-content:space-around;
    background:rgba(19,23,66,1) !important;
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: bold;
    font-size: 16px;
    color:#A1AFD3;
    padding:15px 0px;
}

.tournament{
    height: 88px;
    background-repeat: no-repeat;
    mix-blend-mode: normal;
    background-color: rgba(19,23,66,1);
    span.tournament-name {
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        line-height: 94%;
        color:#E7E7E7;
        font-size:16px;
        max-width: 216px;
        text-align: center;

        margin-left:160px;
        padding:30px 0px;
    }
    span.tournament-time{
        font-family: Telegraf-UltraBold, serif;
        font-weight: bold;
        color:#BE1338;
        font-size:24px;
    }
}
</style>
