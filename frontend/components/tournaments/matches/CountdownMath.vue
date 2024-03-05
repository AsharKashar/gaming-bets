<template>
  <div class="countdown-math">
    <div
      class="heading"
      v-text="$t('Time left')"
    />
    <client-only>
      <countdown
        :is-hours="false"
        :tomorrow="new Date(date)"
      />
    </client-only>
  </div>
</template>

<script>
import Countdown from 'components/Countdown';
import dayjs from 'dayjs';

export default {
  name: 'CountdownMath',
  components: { Countdown },
  props: {
    date: {
      type: String,
      default: () => dayjs(new Date()).add(10, 'm').toISOString(),
    }
  },
};
</script>

<style lang="scss" scoped>
@import '~/assets/styles/colors';

.countdown-math {
  text-align: center;
  color: $text-primary-color;
  .heading {
    text-transform: uppercase;
    margin-bottom: 8px;
    font-size: 12px;
  }

  &::v-deep {
    .countdown {
      max-width: 100%;
    }
    .time {
      font-size: 20px;
      justify-content: center;
      letter-spacing: 1px;
      margin-bottom: 2px;
    }
    .labels {
      font-size: 12px;
      justify-content: space-around;
      max-width: 95px;
      margin: 0 auto;
    }
  }
}
</style>
