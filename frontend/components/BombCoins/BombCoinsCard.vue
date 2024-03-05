<template>
  <div
    class="bomb-coins-card"
  >
    <div
      class="bomb-coins-card__inner"
      :class="{
        'reach-card':bombPackage.bombs >= 500
      }"
    >
      <div class="bombs-count">
        {{ bombsCount }}
        <div
          v-if="bombPackage.free_bombs"
          class="free-bombs-count"
        >
          +{{ bombPackage.free_bombs }} free
        </div>
      </div>

      <div
        v-if="isDescription"
        class="points-list"
      >
        <div
          v-for="(point,i) in bombPackage.description"
          :key="i"
          class="point-item"
        >
          <div class="point-mark" />
          <div class="point-text">
            {{ point }}
          </div>
        </div>
      </div>
      <div class="bombs-image">
        <bomb-icons :count-bomb="bombPackage.bombs" />
      </div>
      <div class="buy-block">
        <default-button
          type="button"
          :on-click="() => buyCoins(bombPackage)"
        >
          <div>{{ $t('Buy') }}</div>
          <div>€{{ bombPackage.price }}</div>
        </default-button>
      </div>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import BombIcons from 'components/svgIcons/BombIcons';

export default {
  name: 'BombCoinsCard',
  components: {
    BombIcons,
    DefaultButton,
  },
  props: {
    bombPackage: {
      type: Object,
      default: () => {},
    },
    buyCoins: {
      type: Function,
      default: () => {},
    },
    isDescription: {
      type: Boolean,
      default: true,
    }
  },
  data: () => ({
    points: [
      'Enter cash prize tournaments',
      'Purchase from our live store',
      'Exchange bombs into your preferred currency (no extra fees)',
    ],
  }),
  computed: {
    bombsCount() {
      const { bombs } = this.bombPackage;

      if (bombs >= 1000) {
        return `${bombs / 1000}k bombs`;
      }

      return `${bombs} bombs`;
    },
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors";
  @import "~/assets/styles/sizes.scss";

  .bomb-coins-card {
    max-width: 100%;
    max-height: 390px;
    margin-bottom: 62px;
    padding: 0 4px;
    width: 100%;
    min-height: 182px;
    &__inner {
      height: 100%;
      position: relative;
      border: 5px solid $border-primary-color;
      border-radius: 17px;
      padding: 19px 16px 154px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }

    .bombs-count,
    .free-bombs-count {
      font-size: 20px;
    }

    .bomb-card-top,
    .bomb-card-bottom {
      width: 100%;
    }

    .bombs-count,
    .free-bombs-count {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 900;
      line-height: 1.2;
      text-transform: uppercase;
      width: 100%;
    }

    .bombs-count {
      color: $accent-error-color;
    }

    .free-bombs-count {
      color: $text-primary-color;
    }

    .points-list {
      display: flex;
      flex-direction: column;

      .point-item {
        display: flex;
        justify-content: flex-start;

        .point-mark {
          border: 2px solid $border-primary-color;
          border-radius: 50px;
        }

        .point-text {
          font-family: Telegraf-Regular, serif;
          font-style: normal;
          font-weight: normal;
          line-height: 120%;
          color: $text-primary-color;
        }
      }
    }

    .bombs-image {
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      bottom: 40px;

      img {
        max-height: 115px;
        max-width: 100px;
      }
    }

    .buy-block {
      position: absolute;
      bottom: -29px;

      &::v-deep .default-banger-btn {
        padding: 0;
        height: 60px;
        width: 142px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 900;
        font-size: 17px;
        line-height: 120%;
        text-align: center;
        text-transform: uppercase;
        color: $app-background;

        &:hover {
          color: white;
        }
      }
    }
  }

  .reach-card {
    border: 5px solid $text-primary-color;

    &::v-deep .default-banger-btn {
      background: $text-primary-color;

      &:hover {
        box-shadow: 3px 20px 30px rgba(160, 175, 211, 0.28);
      }
    }

    .bombs-count {
      color: $text-primary-color;
    }

    .free-bombs-count {
      color: $text-primary-color;
    }
  }


  @media all and (min-width: $min-resolution) {
    .bomb-coins-card {
      flex: 0 0 100%;
      max-width: 100%;
      .points-list {
        display: none;
      }
    }
  }

  @media all and (min-width: $mobile-width) {
    .bomb-coins-card {
      flex: 0 0 50%;
      max-width: 50%;
    }
  }

  @media all and (min-width: $tablet-small-width) {
    .bomb-coins-card {
      .bombs-count,
      .free-bombs-count {
        font-size: 36px;
      }
    }
    .points-list {
      display: block !important;
      margin-top: 16px;

      .point-item {
        margin-bottom: 9px;

        .point-mark {
          min-width: 13px;
          min-height: 13px;
          height: 13px;
          width: 13px;
        }

        .point-text {
          font-size: 15px;
          margin-left: 12px;
        }
      }
    }
  }

  @media all and (min-width: 1200px) {
    .bomb-coins-card {
      flex: 1 0 33.333333%;
      max-width: 33.3333333%;
    }
  }

  @media all and (min-width: $desktop-width) {
  }


</style>
