<template>
  <v-row
    no-gutters
    class="full-width-row"
  >
    <div class="common-gradiant-box left-gradiant-box" />
    <div class="common-gradiant-box right-gradiant-box" />
    <v-col
      v-if="games.length"
      md="12"
      class="text-center"
    >
      <v-progress-circular
        v-if="loading"
        :size="50"
        indeterminate
        color="primary"
      />
      <client-only>
        <carousel
          v-if="!loading"
          rewind
          :dots="optionsCarousel.dots"
          :nav="optionsCarousel.nav"
          :auto-width="optionsCarousel.autoWidth"
          :responsive="optionsCarousel.responsive"
          class="custom-carousal modes-block"
          @changed="handleChange"
        >
          <div
            v-for="game in games"
            :key="game.id"
            class="game-mode-block__wrap"
            :class="{ disabled: !game.tournaments_count }"
          >
            <div
              class="game-mode-block"
              :class="{
                'active-filter': game.id === +$route.query['gameMode'],
              }"
              @click="setRout(game)"
            >
              <div
                class="game-mode-cover"
                :style="gameModeCardStyle(game.image_public_url)"
              >
                <div class="single-game-icon">
                  <v-img
                    max-width="100%"
                    max-height="100%"
                    :src="game.cover_public_url"
                  />
                </div>

                <div class="action-wrap">
                  <div class="type-name">
                    {{ game.name }}
                  </div>
                  <div class="tournaments-count">
                    {{ game.tournaments_count }} {{ $t(" tournaments") }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <template slot="prev">
            <div class="next-arrow">
              <arrow icon-fill="#fff" />
            </div>
          </template>

          <template slot="next">
            <div class="prev-arrow">
              <arrow icon-fill="#fff" />
            </div>
          </template>
        </carousel>
      </client-only>
      <div class="slide-controls">
        <div class="slide-dots">
          <div
            v-for="i in games.length"
            :key="i"
            class="dot"
            :class="{ 'active-dot': i === slideIndex + 1 }"
          >
            <div class="subdot" />
          </div>
        </div>
      </div>
    </v-col>
  </v-row>
</template>

<script>
const carousel = () => process.browser ? import ('vue-owl-carousel') : null;
import Arrow from 'components/svgIcons/Arrow';

export default {
  name: 'SquareCardForList',
  components: { carousel, Arrow },
  props: {
    onClick: {
      type: Function,
      default: () => {},
    },
    games: {
      type: Array,
      default: () => [],
    },
    loading: {
      type: Boolean,
      default: false,
    },
  },
  data: () => ({
    slideIndex: 0,
    optionsCarousel: {
      dots: false,
      nav: false,
      autoWidth: true,
      responsive: {
        0: {
          center: true,
        },
        768: {
          center: false,
        }
      }
    }
  }),
  mounted() {},
  methods: {
    handleChange(event) {
      this.slideIndex = event ? event.item.index : 0;
    },
    gameModeCardStyle(src) {
      return {
        'background-image': `linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%), linear-gradient(180deg, #010432 0%, rgba(1, 4, 50, 0) 100%), url(${src})`,
      };
    },
    setRout(item) {
      if (item.tournaments_count) {
        this.$router.push('/tournaments/games/' + item.id);
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.full-width-row {
  position: relative;
}
//

.common-gradiant-box {
  height: 100%;
  width: 120px;
  position: absolute;
  z-index: 2;

  &.left-gradiant-box {
    left: 0;
    background: linear-gradient(
      90deg,
      $app-background 5%,
      rgba(9, 9, 121, 0) 45%
    );
  }
  &.right-gradiant-box {
    right: 0;
    background: linear-gradient(
      270deg,
      $app-background 5%,
      rgba(9, 9, 121, 0) 45%
    );
  }
}

.custom-carousal {
  position: relative;
  &::v-deep .owl-stage {
    margin: auto;
  }
  &::v-deep {
    span {
      position: absolute;
      top: calc(50% - 45px);
      // justify-content: space-between;
      // width: 100%;
      cursor: pointer;
      z-index: 2;
    }

    > span:first-child {
      left: 0;
    }

    > span:last-child {
      right: 0;
    }

    .next-arrow,
    .prev-arrow {
      background: $border-primary-color;
      height: 78px;
      width: 28px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 9px 0 0 9px;
      position: relative;

      &:before,
      &:after {
        content: "";
        height: 13px;
        width: 23px;
        right: 0;
        background: $border-primary-color;
        position: absolute;
      }

      &:before {
        content: "";
        top: -12px;
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
      }

      &:after {
        content: "";
        bottom: -12px;
        clip-path: polygon(100% 100%, 0% 0%, 100% 0%);
      }
    }

    .next-arrow {
      transform: matrix(-1, 0, 0, 1, 0, 0);
    }
  }
}
// ------------------------
.modes-block {
  display: flex;
  // margin: 15px -12px;
  flex-wrap: wrap;

  .game-mode-block {
    // width: 100%;
    // height: 215px;
    border-radius: 20px;
    clip-path: polygon(
      2% 58%,
      0 55%,
      0 0,
      100% 0,
      100% 55%,
      98% 58%,
      98% 84%,
      100% 87.5%,
      100% 100%,
      0 100%,
      0 87%,
      2% 84%
    );
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
    background: #a0aed3;

    &__wrap {
      width: 100%;
      padding: 0 5px;
    }

    &.active-filter,
    &:hover {
      background: $accent-error-color;
      cursor: pointer;
    }

    .game-mode-cover {
      top: 0;
      left: 0;
      height: calc(100% - 3px);
      width: calc(100% - 4px);
      clip-path: polygon(
        2% 57.5%,
        0 54.5%,
        0 0,
        100% 0,
        100% 54.5%,
        98% 57.5%,
        98% 85%,
        100% 89%,
        100% 100%,
        0 100%,
        0% 88%,
        2% 85%
      );
      border-radius: 20px;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      flex-direction: column;
      mix-blend-mode: normal;

      .single-game-icon {
        max-width: 70%;
      }

      .action-wrap {
        position: absolute;
        bottom: 0%;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: space-between;
        height: 120px;

        .type-name {
          text-transform: uppercase;
          color: $text-primary-color;
        }

        .tournaments-count {
          color: #e7e7e7;
          margin-bottom: 24px;
        }

        .tournaments-count,
        .type-name {
          font-family: Telegraf-UltraBold, serif;
          font-weight: 800;
          font-style: normal;
          width: 100%;
          text-align: center;
        }
      }
    }
  }
}

@media only screen and (min-width: $min-resolution) {
  .modes-block {
    .game-mode-block {
      width: 267px;
      height: 357px;

      .type-name {
        font-size: 24px;
        line-height: 110%;
      }
      .tournaments-count {
        font-size: 16px;
        line-height: 120%;
      }
    }
  }
  .custom-carousal {
    &::v-deep {
      span,
      .next-arrow,
      .prev-arrow {
        display: flex !important;
      }
    }
  }
  .slide-controls {
    display: flex;
  }
}
@media only screen and (min-width: $tablet-small-width) {
  .full-width-row {
    margin: 0 -3%;
  }
  .modes-block {
    .game-mode-block {
      width: 330px;
      height: 440px;

      .type-name {
        font-size: 32px;
        line-height: 100%;
      }
      .tournaments-count {
        font-size: 24px;
        line-height: 130%;
      }
      &__wrap {
        padding: 0 11px;
      }
    }
  }
  .custom-carousal {
    &::v-deep {
      span,
      .next-arrow,
      .prev-arrow {
        display: none !important;
      }
    }
  }
  .slide-controls {
    display: none;
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .full-width-row {
    margin: 0 -5%;
  }
}

@media all and (min-width: $desktop-width) {
  .full-width-row {
    margin: 0 -14% 0 -8%;
  }
}

.slide-controls {
  justify-content: center;
  width: 100%;
  align-items: center;
  margin-top: 18px;

  .slide-dots {
    display: flex;
    justify-content: center;
    height: 40px;
    background: $app-background;
    align-items: center;
    padding: 0 25px;
    position: relative;
    border-radius: 12px 12px 0 0;

    &:after,
    &:before {
      content: "";
      clip-path: polygon(100% 0, 0% 100%, 100% 100%);
      background: $app-background;
      position: absolute;
      height: 40px;
      top: 0;
      height: 40px;
      width: 24px;
      border-radius: 50px 50px 0 0;
    }

    &:before {
      right: -19px;
      transform: matrix(-1, 0, 0, 1, 0, 0);
    }

    &:after {
      left: -19px;
    }

    .dot {
      height: 4px;
      width: 30px;
      margin: 0px 9px;
      border-radius: 50px;
      background: rgba(231, 231, 231, 0.2);

      .subdot {
        height: 4px;
        width: 24px;
        border-radius: 50px;
      }

      &.active-dot {
        background: rgba(190, 19, 56, 0.5);

        .subdot {
          background: $border-primary-color;
        }
      }
    }
  }
}
</style>
