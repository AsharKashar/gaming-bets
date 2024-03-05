<template>
  <div>
    <div class="tournament-footer">
      <p class="match-status">
        Match will start
      </p>
      <count-down class="count-down" />
    </div>
    <!-- <div class="tournament-footer">
      <p class="match-status">Round 4/8</p>
    </div> -->
  </div>
</template>

<script>
import CountDown from 'components/Countdown.vue';
export default {
  components: {
    CountDown,
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";
.tournament-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1em;

  .count-down {
    margin-right: 5em;
    &::v-deep {
      .time {
        font-size: 24px;
        min-width: 115px;
      }
      .labels {
        font-size: 16px;
      }
    }
  }
}
</style>
