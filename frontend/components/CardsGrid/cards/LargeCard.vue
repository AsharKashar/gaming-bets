<template>
  <div
    class="grid-card large-card"
    @click="openCard"
  >
    <div class="background-block-color">
      <div class="arrow-fix" />
    </div>
    <div
      :style="cardStyle"
      class="background-block"
    />
    <v-clamp
      autoresize
      :max-lines="2"
      class="category-title"
    >
      {{ title }}
    </v-clamp>
    <div class="bottom-arrow">
      <div class="arrow-wrapper">
        <div class="background-color-block" />
        <div class="arrow">
          <arrow icon-fill="#fff" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Arrow from 'components/svgIcons/Arrow';
import VClamp from 'vue-clamp';

export default {
  name: 'LargeCard',
  components: {
    Arrow,
    VClamp,
  },
  props: {
    onClick: {
      type: Function,
      default: () => {},
    },
    title: {
      type: String,
      default: 'Untitled',
    },
    backgroundImage: {
      type: String,
      default: '',
    },
    slug: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      cardStyle: {
        'background-image': `url(${this.backgroundImage})`,
      },
    };
  },
  methods: {
    openCard() {
      this.$router.push(`/${this.slug}`);
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.large-card {
  display: flex;
  position: relative;
  align-items: flex-start;
  flex-direction: column;
  background: $app-background;
  border-radius: 16px;

  &:hover {
    background: $border-primary-color;
    cursor: pointer;

    .bottom-arrow {
      background: $border-primary-color;
    }
  }

  .category-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    z-index: 1;
    text-transform: capitalize;
    max-width: 60%;
  }

  .bottom-arrow {
    position: absolute;
    bottom: 0;
    right: 0;
    clip-path: polygon(
      100% 0,
      99% 4%,
      98% 8%,
      97% 10%,
      96% 12%,
      95% 13%,
      12% 94%,
      11% 95%,
      8% 97%,
      6% 98%,
      5% 98.5%,
      0% 100%,
      100% 100%
    );
    background: $app-background;
    height: 90px;
    width: 97px;
    .arrow-wrapper {
      position: relative;
      height: 100%;
      width: 100%;

      .background-color-block {
        background: $app-background;
        clip-path: polygon(
          100% 0,
          100% 4%,
          99% 8%,
          98% 10%,
          96% 12%,
          95% 13%,
          12% 94%,
          11% 95%,
          9% 97%,
          7% 98.5%,
          6% 98.9%,
          3% 100%,
          100% 100%
        );
        height: calc(100% - 3px);
        width: calc(100% - 3px);
        bottom: 0;
        position: absolute;
        right: 0;
      }
    }

    .arrow {
      background: $border-primary-color;
      position: absolute;
      bottom: 0;
      right: 0;
      height: 60px;
      width: 65px;
      clip-path: polygon(
        100% 0,
        91% 0%,
        89% 1%,
        5% 83%,
        2% 87%,
        -4% 100%,
        100% 99%
      );
      border-radius: 5px;
      cursor: pointer;

      svg {
        position: absolute;
        bottom: 13px;
        right: 15px;
      }
    }
  }

  .background-block,
  .background-block-color {
    background-size: cover;
    background-position: center;
    position: absolute;
    top: 2px;
    left: 2px;
    width: calc(100% - 4px);
    height: calc(100% - 4px);
    border-radius: 16px;
    z-index: 0;
  }

  .background-block-color {
    background: $app-background;

    .arrow-fix {
      position: absolute;
      bottom: -3px;
      right: -3px;
      clip-path: polygon(
        100% 0,
        99% 7%,
        98% 8%,
        97% 10%,
        96% 12%,
        95% 13%,
        12% 94%,
        11% 95%,
        8% 97%,
        6% 98%,
        5% 98.5%,
        0% 100%,
        100% 100%
      );
      background: $app-background;
      height: 90px;
      width: 97px;
    }
  }

  .background-block {
    opacity: 0.5;
  }
}

@media only screen and (min-width: $min-resolution) {
  .large-card {
    height: 192px;
    width: 100%;
    margin-bottom: 24px;
    align-items: flex-start;
    justify-content: center;

    .category-title {
      font-size: 32px;
      line-height: 120%;
      letter-spacing: 0.03em;
      padding: 0 32px;
      max-width: 90%;
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .large-card {
    height: 240px;
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .large-card {
    height: 429px;
    flex-basis: 31.5%;
    justify-content: flex-end;

    .category-title {
      font-size: 23px;
      line-height: 120%;
      letter-spacing: 0.03em;
      padding: 0 22px 54px;
      max-width: 90%;
    }
  }
}

@media only screen and (min-width: $desktop-width) {
  .large-card {
    height: 528px;
    flex-basis: 31.5%;

    .category-title {
      font-size: 32px;
      line-height: 120%;
      letter-spacing: 0.03em;
      padding: 0 27px 41px;
    }
  }
}
</style>
