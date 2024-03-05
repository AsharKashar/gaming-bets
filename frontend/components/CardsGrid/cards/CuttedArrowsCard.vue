<template>
  <div
    class="cutted-arrows-card"
    :class="{
      'cutted-arrows-card-disabled':disabled
    }"
  >
    <div class="item-background-wrapper">
      <div class="item-background__inner">
        <div
          class="item-background"
          :style="{background: bgStyle}"
        />
        <div class="item-info">
          <img
            v-if="cover"
            class="game-cover"
            :src="cover"
            alt="game-cover"
          >
          <div
            class="item-caption"
            v-text="caption"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CuttedArrowsCard',
  props: {
    background: {
      type: String,
      default: '',
    },
    cover: {
      type: String,
      default: '',
    },
    caption: {
      type: String,
      default: '',
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    bgStyle() {
      let gradient = 'linear-gradient(270.12deg, rgba(1, 4, 50, 0) 71.7%, #010432 84.7%), linear-gradient(270deg, #010432 22.48%, rgba(1, 4, 50, 0) 30.18%), linear-gradient(180deg, rgba(1, 4, 50, 0) 42.08%, #010432 100%)';
      if (this.disabled) {
        gradient = 'linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%)';
      }

      return `${gradient}, url(${ this.background }) 50% / cover no-repeat`;
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.item-background-wrapper {
  min-height: 244px;
  clip-path: polygon(4% 0, 100% 0, 100% 90%, 96% 100%, 0 100%, 0 11%);
  background: rgba(161, 175, 211, 0.4);
  padding: 1px;
  width: 100%;
  height: 100%;

  &:hover {
    background: $border-primary-color;
    cursor: pointer;
  }

  .item-background {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    mix-blend-mode: luminosity;
    &__inner {
      position: relative;
      height: 100%;
      clip-path: polygon(4% 0, 100% 0, 100% 90%, 96% 100%, 0 100%, 0 11%);
    }
  }
  .item-info {
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    z-index: 2;
    .game-cover {
      margin-bottom: 20px;
    }
  }
}

.item-caption {
  font-weight: 800;
  line-height: 1.2;
  color: $border-primary-color;
}

.cutted-arrows-card-disabled {
  .item-background {
    &-wrapper {
      padding: 0;
      cursor: not-allowed;
    }
    &__inner {
      &::before {
        content: '';
        background: $app-background;
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
      }
    }
  }
}
</style>
