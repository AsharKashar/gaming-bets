<template>
  <div>
    <div class="cong-wrapper">
      <p class="cong-heading">
        {{ $t('Congratulations') }}
      </p>
      <p class="con-sub-heading">
        {{ $t('New coins have been added.') }}
      </p>
      <img
        src="/img/small_bombs_bunch.d06eccad.png"
        alt
      >
      <p class="total-coins">
        {{ $t('Previous Coins') }}
        <label>{{ preCoins }}</label>
      </p>
      <p class="total-coins">
        {{ $t('Total Coins') }}
        <label>{{ totalCoins }}</label>
      </p>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const bombsModule = createNamespacedHelpers('bombs');
export default {
  computed: {
    ...bombsModule.mapState(['totalCoins', 'preCoins']),
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";
.cong-wrapper {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-family: "Telegraf-UltraBold", serif;
  font-style: normal;
  padding: 36px 40px;
  .cong-heading {
    font-size: 2em;
    font-weight: 900;
    color: #be1338;
    margin-bottom: 10px;
  }
  .total-coins {
    width: 100%;
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
  }
}

@media all and (max-width: $tablet-small-width) {
  .cong-wrapper {
    padding: 15px 5px;
    .cong-heading {
      font-size: 1.3em;
    }
    .total-coins {
      font-size: 1em;
    }
  }
}
</style>
