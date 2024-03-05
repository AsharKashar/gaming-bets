<template>
  <div class="bomb-coins">
    <home-title
      :title="$t('Bomb Coins & Memberships')"
      description="Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis"
      class="tournament-title"
    />
    <div class="bombs-components">
      <router-link
        to="/coins"
        class="bombs-block bombs"
      >
        <div class="block-title">
          {{ $t('Bomb Coins') }}
        </div>
        <img
          v-lazy-load
          src="~/static/demo/bombs.png"
        >
      </router-link>
      <router-link
        to="/membership"
        class="bombs-block bombs-box"
      >
        <div class="block-title">
          {{ $t('Membership') }}
        </div>
        <img
          v-lazy-load
          src="~/static/demo/bombs-box.png"
        >
      </router-link>
    </div>
  </div>
</template>

<script>
import HomeTitle from 'components/HomeTitle.vue';

export default {
  name: 'BombCoinsMembership',
  components: {
    HomeTitle,
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.tournament-title {
  margin-top: 110px;
}
.bombs-components {
  display: flex;
  justify-content: space-between;

  .bombs-block {
    border: 7px solid $border-primary-color;
    border-radius: 19px;
    position: relative;
    text-decoration: none;
  }

  .bombs,
  .bombs-box {
    img {
      position: absolute;
      bottom: -100px;
      left: 50%;
      transform: translate(-50%, 0);
    }
  }

  .block-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    line-height: 76px;
    display: flex;
    align-items: center;
    color: $border-primary-color;
  }
}

@media all and (min-width: $tablet-small-width) {
  .bombs-components {
    flex-wrap: wrap;
    margin-top: 20px;

    .bombs-block {
      height: 247px;
      margin-bottom: 100px;
      flex-basis: 100%;
    }

    .block-title {
      font-size: 42px;
    }
  }
}

@media all and (max-width: $tablet-small-width) {
  .bombs-components {
    flex-wrap: wrap;
    margin-top: 20px;

    .bombs-block {
      height: 200px;
      margin-bottom: 100px;
      flex-basis: 100%;
    }

    .bombs,
    .bombs-box {
      img {
        width: 100%;
        max-width: 300px;
        bottom: -70px;
      }
    }

    .block-title {
      font-size: 30px;
      justify-content: center;
    }
  }
}

@media all and (min-width: $desktop-width) {
  .bombs-components {
    flex-wrap: nowrap;
    margin-top: 45px;

    .bombs-block {
      height: 373px;
      flex-basis: 49%;
    }

    .block-title {
      font-size: 72px;
      padding: 24px 14px;
    }
  }
}

@media all and (max-width:$tablet-small-width){
  .bomb-coins{
    padding: 0 20px;
  }
}
</style>
