<template>
  <div
    class="tournament-nav"
    :class="`tournament-nav--${navStyle}`"
  >
    <client-only v-if="isCarousel">
      <carousel
        class="tournament-nav__list"
        rewind
        :dots="optionsCarousel.dots"
        :nav="optionsCarousel.nav"
        :auto-width="optionsCarousel.autoWidth"
        :responsive="optionsCarousel.responsive"
      >
        <child-link
          v-for="item in navToProps"
          :key="item.title"
          :data="item"
        />
      </carousel>
    </client-only>
    <div
      v-else
      class="tournament-nav__list"
    >
      <child-link
        v-for="item in navToProps"
        :key="item.title"
        :data="item"
      />
    </div>
  </div>
</template>

<script>
import ChildLink from 'components/child-navigation/ChildLink';
const Carousel = () => process.browser ? import ('vue-owl-carousel') : null;

export default {
  name: 'ChildNavigation',
  components: {ChildLink,Carousel},
  meta: {
    savePosition: true,
  },
  props: {
    nav: {
      type: Array,
      default: () => [
        {
          title: 'Overview',
          name: 'tournamentOverview',
        },
        {
          title: 'Rules',
          name: 'tournamentRules',
        },
        {
          title: 'Prize Pool',
          name: 'tournamentPrizePool',
        },
        {
          title: 'Participants',
          name: 'tournamentParticipants',
        },
        {
          title: 'Brackets',
          name: 'tournamentBrackets',
        },
        {
          title: 'Matches',
          name: 'tournamentMatches',
        },
        {
          title: 'Leaderboards',
          name: 'tournamentLeaderboards',
        },
      ],
    },
    savePosition: {
      type: Boolean,
      default: true,
    },
    isCarousel: {
      type: Boolean,
      default: true,
    },
    navStyle: {
      type: String,
      default: 'main',
    },
    propCarousel: {
      type: Object,
      default: () => ({}),
    }
  },
  data: () => ({
    defaultOptionsCarousel: {
      dots: false,
      nav: false,
      autoWidth: true,
      responsive: {
        0: {
          center: true,
        },
        568: {
          center: false,
        }
      }
    }
  }),
  computed: {
    navToProps() {
      return this.nav.map((item) => {
        item.params = {
          ...item.params,
          savePosition: this.savePosition
        };
        return item;
      });
    },
    optionsCarousel() {
      return ({
        ...this.defaultOptionsCarousel,
        ...this.propCarousel,
      });
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.tournament-nav {
  &--main {
    margin-bottom: 49px;
    .tournament-nav {
      &__list {
        display: flex;
        font-size: 20px;
        line-height: 1.2;
        background: $secondary-background;
        clip-path: polygon(19px 0, calc(100% - 10px) 0, 100% 17px, calc(100% - 19px) 100%, 11px 100%, 0 61px);
        width: auto;
        max-width: max-content;
        flex-wrap: wrap;
      }
    }
    &::v-deep {
      .owl-item {
        &:not(:last-child) {
          .tournament-nav__item {
            margin-right: -16px;
            &::before {
              content: "";
              width: 2px;
              height: 28px;
              position: absolute;
              top: 50%;
              right: 0;
              z-index: 1;
              transform: translateY(-50%) rotate(20deg);
              background: $text-primary-color;
            }
          }

        }
      }
      .tournament-nav__item {
        display: block;
        text-align: center;
        position: relative;
        width: 188px;
        &:hover,
        &.nuxt-link-active {
          z-index: 2;
          &::before {
            display: none;
          }
          .tournament-nav__item-inner {
            background: $border-primary-color;
          }
        }
        &-inner {
          display: inline-block;
          width: 100%;
          padding: 3px;
          clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
          transition: 0.5s easy;
        }
        &-link {
          display: block;
          padding: 24px 15px;
          cursor: pointer;
          background: $secondary-background;
          clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
        }
      }
    }
  }
  &--second-stile {
    margin-bottom: 56px;
    .tournament-nav {
      &__list {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        border-bottom: 1px solid rgb(161 175 211 / .2);
      }
    }
    &::v-deep {
      .tournament-nav__item {
          min-width: 200px;
          text-decoration: none;
          text-align: center;
          display: block;
          padding: 17px 15px;
          font-weight: 900;
          font-size: 16px;
          line-height: 1.2;
          color: #313762;
          position: relative;
          &.nuxt-link-active {
            color: $border-primary-color;
            &::before {
              content: '';
              position: absolute;
              left: 0;
              right: 0;
              bottom: -1px;
              height: 2px;
              background: $border-primary-color;
            }
          }
        }
    }
  }
}

@media all and (max-width: $tablet-small-width){
  .tournament-nav {
    &--main {
      .tournament-nav {
        &__list {
          clip-path: none;
        }
      }
      &::v-deep {
        .owl-item {
          &:not(:last-child) {
            .tournament-nav__item {
              margin-right: 0;
              &::before {
                display: none;
              }
            }
          }
        }
        .tournament-nav__item {
          width: auto;
          padding: 0 15px 0;
          &-inner {
            clip-path: none;
            padding: 0 0 3px;
          }
          &-link {
            clip-path: none;
          }
        }
      }
    }
  }
}

</style>
