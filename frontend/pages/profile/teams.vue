<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div>
    <loader
      :loading="loadFilter"
      :overlay="false"
      class="mobile-scroll"
      :class="{loaderbox:loadFilter}"
    >
      <div
        v-if="!loadFilter"
        class="tournaments-tabs"
      >
        <p class="main-title mb-6">
          My Teams
        </p>
        <client-only>
          <carousel
            class="tournaments-tabs-button"
            rewind
            :dots="false"
            :nav="false"
            auto-width
          >
            <tournament-tab-button
              v-for="(game, i) in games"
              :key="i"
              :value="currentGame.id"
              :item="game"
              :v-value="game.id"
              name="test-radio"
              :on-click="
                () => {
                  updateFilters({ gameId: game.id, page: 1 });
                }
              "
            />
          </carousel>
        </client-only>
        <!-- <tournament-tab-button
          v-for="(game,i) in games"
          :key="i"
          :value="currentGame.id"
          :item="game"
          :v-value="game.id"
          name="test-radio"
          :on-click="() => {updateFilters({'gameId':game.id, 'page':1})}"
        /> -->
        <div class="tournament-nav">
          <div class="tournament-nav__list">
            <div
              v-for="({id, name, size}, index) in teamTypes"
              :key="index + name"
              class="tournament-nav__item"
              :class="{'active': index === currentSize}"
              @click="updateFilters({'teamSizeId':id, 'page':1})"
            >
              <div class="tournament-nav__item-inner">
                <div
                  class="tournament-nav__item-link"
                  v-text="getTabName(size)"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </loader>
    <loader
      :loading="teamsAreLoading"
      :overlay="false"
      class="mobile-scroll"
      :class="{loaderbox:teamsAreLoading}"
    >
      <div v-if="!teamsAreLoading">
        <div v-if="teams.data.length">
          <teams-list :teams-list="teams.data" />
          <pagination
            :page="+$route.query.page"
            :total="teams.last_page"
            :set-page="page => updateFilters({page})"
          />
        </div>
        <div v-if="!teams.data.length">
          <no-teams :game="currentGame" />
        </div>
      </div>
    </loader>
    <team-details v-if="activeTeam.team_id === +$route.query.teamId" />
  </div>
</template>

<script>
const carousel = () => (process.browser ? import('vue-owl-carousel') : null);

import TournamentTabButton from 'components/BrowseTournaments/TournamentTabButton';
import TeamsList from 'components/TeamsList';
import Pagination from 'components/Pagination';
import NoTeams from 'components/TeamsList/NoTeams';
import Loader from 'components/Loader.vue';
import TeamDetails from 'components/teamDetails/TeamDetails';
import gameFilter from 'mixins/gameFilter';
import { STATE_STATUSES } from 'helpers/constants';
import { createNamespacedHelpers } from 'vuex';
const { mapState, mapMutations } = createNamespacedHelpers('team');
import { APP_URL } from 'configs/config';

export default {
  name: 'ProfileTeam',
  components: {
    TeamDetails,
    TeamsList,
    Pagination,
    Loader,
    NoTeams,
    carousel,
    TournamentTabButton,
  },
  middleware: ['hideHeader'],
  mixins: [gameFilter],
  computed: mapState(['activeTeam']),
  beforeDestroy() {
    this.setTeams({ teams: { data: [] } });
    this.setTeamsStatus(STATE_STATUSES.INIT);
  },
  methods: {
    ...mapMutations(['setTeams', 'setTeamsStatus']),
    getTabName(size) {
      switch (size) {
        case 1:
          return 'solo (1)';
        case 2:
          return 'duo (2)';
        case 3:
          return 'trio (3)';
        case 4:
          return 'quartet (4)';
        case 5:
          return 'quintet (5)';
        default:
          return '';
      }
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Teams',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.tournaments-tabs {
   display: flex;
  flex-wrap: wrap;
  margin-bottom: 83px;
  padding: 10px 0 0;
  .main-title {
    font-weight: 900;
    font-size: 32px;
    line-height: 115%;
    color: $text-primary-color;
  }
}

.tournaments-tabs {
  &::v-deep .item-icon {
    height: 42px;
    width: 42px;
  }
  &::v-deep .item-name {
    font-size: 12px;
    margin: 0 29px 0 13px;
  }
}

.mobile-scroll {
  max-width: 100vw;
  overflow: hidden;
  width: 100%;
}

.pagination-container {
  margin-bottom: 32px;
}

.loaderbox {
  display: flex;
  justify-content: center;
  padding: 20% 0;
}

@media only screen and (max-width: $mobile-width) {
  .tournaments-tabs {
    padding: 22px 0;
  }
}
.tournament-nav {
  margin: 32px 0;
  &__list {
    display: flex;
    font-size: 20px;
    line-height: 1.2;
    background: $secondary-background;
    // background: rgba(161, 175, 211, 0.2);
    clip-path: polygon(
      19px 0,
      calc(100% - 10px) 0,
      100% 17px,
      calc(100% - 19px) 100%,
      11px 100%,
      0 61px
    );
    width: auto;
    max-width: max-content;
    flex-wrap: wrap;
    padding: 0 10px;
  }
  &__item {
    display: block;
    text-align: center;
    position: relative;
    width: 160px;
    &:hover,
    &.active {
      z-index: 2;
      &::before {
        display: none;
      }
      .tournament-nav__item-inner {
        background: $border-primary-color;
        color: $text-secondary-color;
      }
    }
    &-inner {
      display: inline-block;
      font-family: Telegraf-UltraBold, serif;
      color: $text-primary-color;
      text-transform: uppercase;
      width: 100%;
      padding: 3px;
      clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
      transition: 0.5s easy;
      font-weight: 900;
      font-size: 16px;
      line-height: 120%;
    }
    &-link {
      padding: 8px 16px;
      cursor: pointer;
      background: $secondary-background;
      // background: rgba(161, 175, 211, 0.2);
      clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
    }
  }
}
</style>
