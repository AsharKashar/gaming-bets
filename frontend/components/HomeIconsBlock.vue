<template>
  <div class="home-icons">
    <div class="icon-item">
      <div class="icon">
        <gamepad />
      </div>
      <div class="icon-label">
        {{ $t('FREE GAMES') }}
      </div>
      <div class="blur" />
    </div>
    <div class="icon-item">
      <div class="icon">
        <global-leader-board />
      </div>
      <div class="icon-label">
        {{ $t('GLOBAL LEADERBOARDS') }}
      </div>
      <div class="blur" />
    </div>
    <div class="icon-item">
      <div class="icon">
        <photo-camera />
      </div>
      <div class="icon-label">
        {{ $t('EASY FAST CASH PAYOUTS') }}
      </div>
      <div class="blur" />
    </div>
  </div>
</template>

<script>
import Gamepad from 'components/svgIcons/Gamepad';
import PhotoCamera from 'components/svgIcons/PhotoCamera';
import GlobalLeaderBoard from 'components/svgIcons/GlobalLeaderBoard';

export default {
  name: 'HomeIcons',
  components: {
    Gamepad,
    PhotoCamera,
    GlobalLeaderBoard,
  },
};
</script>

<style scoped lang="scss">
.home-icons {
  display: flex;
  justify-content: space-around;
  margin-top: 115px;

  .icon-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;

    .icon {
      background: linear-gradient(
        0deg,
        #be1338 -97.2%,
        rgba(190, 19, 56, 0) 38%
      );
      width: 250px;
      height: 250px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .blur {
      position: absolute;
      background: radial-gradient(
          52.26% 52.26% at 50% 52.26%,
          rgba(237, 45, 45, 0) 0%,
          rgba(190, 19, 56, 0.72) 100%
        ),
        linear-gradient(0deg, #be1338 -36.17%, rgba(190, 19, 19, 0.44) 131.65%);
      filter: blur(120px);
      height: 188px;
      width: 188px;
      top: 95px;
    }
  }

  .icon-label {
    margin-top: 36px;
    max-width: 250px;
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    font-size: 23px;
    line-height: 24px;
    display: flex;
    align-items: center;
    text-transform: uppercase;
    color: #a1afd3;
    justify-content: center;
    text-align: center;
  }
}

@media only screen and (max-width: 1439px) {
  .home-icons {
    flex-wrap: wrap;
  }
}
</style>
