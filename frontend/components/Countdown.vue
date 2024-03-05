<template>
  <div
    v-if="tomorrow"
    class="countdown"
  >
    <div class="time">
      {{ days }} {{ hours }} {{ minutes }} {{ seconds }}
    </div>
    <div class="labels">
      <div v-if="days && isHours">
        {{ $t('days') }}
      </div>
      <div v-if="isHours">
        {{ $t('hrs') }}
      </div>
      <div>{{ $t('min') }}</div>
      <div v-if="!days">
        {{ $t('sec') }}
      </div>
    </div>
  </div>
  <div
    v-else
    class="countdown"
  >
    <div
      class="time"
      v-text="timeIsNull"
    />
    <div class="labels">
      <div v-if="isHours">
        {{ $t('hrs') }}
      </div>
      <div>{{ $t('min') }}</div>
      <div>{{ $t('sec') }}</div>
    </div>
  </div>
</template>

<script>
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
export default {
  name: 'Countdown',
  props: {
    tomorrow: {
      type: Date,
      default: () => tomorrow,
    },
    isHours: {
      type: Boolean,
      default: true,
    }
  },
  data() {
    return {
      distance: 0,
      second: 1000,
      minute: 1000 * 60,
      hour: 1000 * 60 * 60,
      day: 1000 * 60 * 60 * 24,
    };
  },
  computed: {
    days() {
      const days = Math.floor(this.distance / this.day);
      if (!this.isHours) {
        return null;
      }
      return days > 0 ? days + ' : ' : null;
    },
    hours() {
      if (!this.isHours) {
        return null;
      }
      const hours = Math.floor((this.distance % this.day) / this.hour);
      return hours > 0 ? ('0' + hours).slice(-2) + ' : ' : '00 : ';
    },
    minutes() {
      const minutes = Math.floor((this.distance % this.hour) / this.minute);
      return minutes > 0 ? ('0' + minutes).slice(-2) + ' : ' : '00 : ';
    },
    seconds() {
      if (this.days) {
        return null;
      }
      const seconds = Math.floor((this.distance % this.minute) / this.second);

      return seconds > 0 ? ('0' + seconds).slice(-2) : '00';
    },
    countdownValues() {
      let _second = 1000;
      let _minute = _second * 60;
      let _hour = _minute * 60;
      let _day = _hour * 24;
      const res = {};
      res.days = Math.floor(this.distance / _day);
      res.hours = Math.floor((this.distance % _day) / _hour);
      res.minutes = Math.floor((this.distance % _hour) / _minute);
      res.seconds = (
        '0' + Math.floor((this.distance % _minute) / _second)
      ).slice(-2);

      return res;
    },
    timeIsNull() {
      if (!this.isHours) {
        return '00 : 00';
      }
      return '00 : 00 : 00';
    }
  },
  created() {
    this.countdownTo(this.tomorrow);
  },
  methods: {
    countdownTo(to) {
      let end = new Date(to);
      let timer;

      const showRemaining = () => {
        let now = new Date();
        this.distance = end - now;
        if (this.distance < 0) {
          clearInterval(timer);
        }
      };

      timer = setInterval(showRemaining, 1000);
    },
  },
};
</script>

<style scoped lang="scss">
.countdown {
  max-width: 415px;

  .time {
    font-weight: 800;
    font-size: 72px;
    line-height: 1.2;
    display: flex;
    align-items: center;
    color: #be1338;
    letter-spacing: -2px;
  }

  .labels {
    font-family: Telegraf-Regular, serif;
    font-weight: normal;
    font-size: 24px;
    line-height: 1.2;
    text-transform: uppercase;
    color: #a1afd3;
    display: flex;

    div {
      flex-basis: 33%;
    }
  }
}

@media only screen and (max-width: 1439px) {
  .countdown {
    max-width: 240px;

    .time {
      font-size: 44px;
    }
  }
}
</style>
