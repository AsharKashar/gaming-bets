<template>
  <div>
    <div
      class="game-cover"
      :style="gameCoverStyle"
    />
    <div
      class="filters-list"
      :class="{ loadTournament }"
    >
      <div class="tournament-heading">
        <div class="tournament-heading__col tournament-heading__col-breadcrumbs">
          <div class="tournaments-title">
            {{ $t("Tournaments") }}
          </div>
          <breadcrumbs
            :breadcrumbs-list="breadcrumbs"
            active-crumb="categoryName"
            :additional-bread-crumbs="additionalBreadCrumbs"
          />
        </div>
        <div class="tournament-heading__col tournament-heading__col--user-info">
          <user-info-heading />
        </div>
      </div>

      <home-title
        :title="$t('Game modes')"
        :subtitle="$t('Select a game mode')"
      />
      <div class="modes-block">
        <div
          v-for="type in gameMode"
          :key="type.id"
          class="game-mode-block__wrap"
        >
          <div
            class="game-mode-block"
            :class="{
              'active-filter': type.id === activeMode
            }"
            @click="toggleFilter({ name: 'gameMode' }, type)"
          >
            <div
              class="game-mode-cover"
              :style="gameModeCardStyle(type.preview_image_url)"
            >
              <div class="type-name">
                {{ type.name }}
              </div>
              <div
                class="tournaments-count"
              >
                {{ type.tournament_count }} {{ $t('tournaments') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HomeTitle from 'components/HomeTitle';
import Breadcrumbs from 'components/Breadcrumbs.vue';
import {createNamespacedHelpers} from 'vuex';
import UserInfoHeading from 'components/UserInfoHeading';

const gameModule = createNamespacedHelpers('game');

export default {
  name: 'GameModes',
  components: {
    UserInfoHeading,
    Breadcrumbs,
    HomeTitle,
  },
  props: {
    toggleFilter: {
      type: Function,
      default: () => {},
    },
    gameMode: {
      type: Array,
      default: () => ({}),
    },
    loadTournament: {
      type: Boolean,
      default: false,
    },
    activeMode: {
      type: Number,
      default: null,
    }
  },
  data: () => ({
    breadcrumbs: ['allGames', 'categoryName'],
  }),
  computed: {
    ...gameModule.mapState(['currentGame']),
    additionalBreadCrumbs() {
      return {
        categoryName: {
          text: this.currentGame.name,
          href: '',
        },
      };
    },
    gameCoverStyle() {
      return {
        'background-image': `linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%), linear-gradient(180deg, #010432 0%, rgba(1, 4, 50, 0) 100%), url('${this.currentGame.image}')`,
        'mix-blend-mode': 'luminosity',
      };
    },
  },
  methods: {
    gameModeCardStyle(src) {
      return ({
        'background': `linear-gradient(180deg, rgba(1, 4, 50, 0) 0%, #010432 100%), url('${src}')  50% /cover no-repeat`,
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.tournament-heading {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  margin: 72px -15px 107px;

  &__col {
    padding: 0 15px 15px;
  }
}


.tournaments-title {
  font-family: Telegraf-UltraBold, serif;
  font-style: normal;
  font-weight: 800;
  line-height: 1.2;
  color: $text-primary-color;
  font-size: 42px;
  padding-left: 3px;
}

.breadcrumbs::v-deep .breadcrumb {
  font-size: 18px;
}

.game-cover {
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  height: 560px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.modes-block {
  display: flex;
  margin: 15px -12px;
  flex-wrap: wrap;

  .game-mode {
    &-block {
      width: 100%;
      height: 215px;
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
        max-width: 50%;
        flex: 0 0 50%;
        padding: 0 11px 16px;
      }

      &.active-filter,
      &:hover {
        background: $accent-error-color;
        cursor: pointer;
      }
    }
    &-cover {
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
      justify-content: flex-end;
      align-items: center;
      flex-wrap: wrap;
      flex-direction: column;

      .type-name {
        font-family: Telegraf-UltraBold, serif;
        font-weight: 800;
        font-size: 24px;
        line-height: 100%;
        text-transform: uppercase;
        color: $text-primary-color;
        margin-bottom: 6px;
      }

      .tournaments-count {
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 800;
        font-size: 18px;
        line-height: 94%;
        color: #e7e7e7;
        margin-bottom: 26px;
      }

      .tournaments-count,
      .type-name {
        width: 100%;
        text-align: center;
      }
    }
  }
}

.loadTournament .modes-block .game-mode-block {
  &.active-filter,
  &:hover {
    cursor: not-allowed;
  }
}

.filters-list {
  position: relative;

  &::v-deep .home-title-content {

    .home-title-wrap {
      padding-left: 25px;

      .home-title {
        font-size: 42px;
        line-height: 1.2;
      }
    }

    .col-left {
      flex-basis: 100%;
    }
  }
}

@media only screen and (max-width: $mobile) {
  .modes-block {
    margin: 15 -5px;
    .game-mode {
      &-block,
      &-cover {
        clip-path: none;
      }
      &-block {
        height: 152px;
        &__wrap {
          padding: 0 5px 10px;
        }
      }
      &-cover {
        .type-name {
          font-size: 20px;
        }
        .tournaments-count {
          font-size: 14px;
        }
      }
    }
  }
}
</style>
