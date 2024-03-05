<template>
  <div
    class="notification-container"
    :style="containerStyle"
  >
    <img
      v-if="properties.item.type === 'success'"
      src="~/static/icons/rounded_check.svg"
    >
    <img
      v-if="properties.item.type === 'error'"
      src="~/static/icons/warning.svg"
    >
    <img
      v-if="properties.item.type === 'warning'"
      src="~/static/icons/warning.svg"
    >
    <img
      v-if="properties.item.type === 'info'"
      src="~/static/icons/warning.svg"
    >
    <div class="notification-info">
      <div class="notification-title">
        {{ properties.item.title }}
      </div>
      <div
        class="notification-text"
        v-html="properties.item.text"
      />
    </div>
    <div
      class="notification-close"
      @click="properties.close"
    >
      <cross color="#262F56" />
    </div>
    <div
      class="custom-progress-bar"
      :style="progressBarStyle"
    />
  </div>
</template>

<script>
import Cross from 'components/svgIcons/Cross';
import { VUE_MODE } from 'config';

export default {
  name: 'CustomSuccessNotification',
  components: {
    Cross
  },
  props: {
    properties: {
      type: Object,
      default: () => []
    }
  },
  data: () => ({
    steps: 0,
    width: 100
  }),
  computed: {
    progressBarStyle() {
      return {
        width: `${this.width}%`
      };
    },
    isDemo() {
      return VUE_MODE === 'production';
    },
    containerStyle() {
      switch (this.properties.item.type) {
        case 'success':
          return {
            background: '#27AE60'
          };
        case 'error':
          return {
            background: '#BE1338'
          };
        case 'info':
          return {
            background: '#2F80ED'
          };
        case 'warning':
          return {
            background: '#F2994A'
          };
        default:
          return {
            background: '#2F80ED'
          };
      }
    }
  },
  mounted() {
    this.runProgress();
  },
  methods: {
    runProgress() {
      let timer;
      const step = 10;
      const stepsCount = parseInt(this.properties.duration / step);

      const changeWidth = () => {
        this.steps += 1;
        this.width = ((stepsCount - this.steps) * 100) / stepsCount;

        if (this.steps >= stepsCount) {
          clearInterval(timer);
        }
      };

      timer = setInterval(changeWidth, step);
    }
  }
};
</script>

<style lang="scss" scoped>

@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.custom-progress-bar {
  position: absolute;
  width: 100%;
  height: 10px;
  background: #010432;
  opacity: 0.4;
}

.notification-container {
  min-height: 96px;
  clip-path: polygon(
    0 0,
    100% 0,
    100% 75%,
    95% 100%,
    0 100%,
    0 84%,
    2% 77%,
    2% 25%,
    0 17%
  );
  margin-top: 10px;
  position: relative;
  display: flex;
  padding: 10px 22px 10px 23px;
  align-items: center;

  .notification-info {
    margin-left: 17px;
    max-width: calc(100% - 60px);
    word-break: break-all;

    .notification-title {
      text-transform: uppercase;
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      font-size: 18px;
    }

    .notification-text {
      font-size: 16px;
    }
  }

  .notification-close {
    position: absolute;

    svg {
      height: 13px;
      width: 13px;
    }
  }
}

@media all and (min-width: $tablet-small-width) {
  .custom-progress-bar {
    bottom: 0;
    left: 0;
  }
  .notification-close {
    right: 18px;
    top: 18px;
  }
}
@media all and (max-width: $tablet-small-width) {
  .custom-progress-bar {
    top: 0;
    left: 0;
  }
  .notification-close {
    right: 10px;
    top: 10px;
  }
  .notification-container {
    padding: 10px 14px 10px 15px;
    .notification-info {
      margin-left: 11px;
    }
  }
}
@media all and (max-width: $mobile-width) {
  .notification-container {
    .notification-info {
      .notification-text {
        font-size: 14px;
      }
    }
  }
}
</style>
