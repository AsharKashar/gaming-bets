<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div>
    <div class="tournaments-tabs">
      <p class="main-title mb-6">
        Joined Tournaments
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

      <!-- TODO: make componentfor nav links other usage Teams.vue -->
      <div class="tournament-nav">
        <div class="tournament-nav__list">
          <div
            v-for="({ id, name }, index) in teamTypes"
            :key="index + name"
            class="tournament-nav__item"
            :class="{ active: index === currentSize }"
            @click="updateFilters({ teamSizeId: id, page: 1 })"
          >
            <div class="tournament-nav__item-inner">
              <div
                class="tournament-nav__item-link"
                v-text="name"
              />
            </div>
          </div>
        </div>
      </div>

      <loader
        :loading="teamsAreLoading"
        :overlay="false"
        class="mobile-scroll"
        :class="{ loaderbox: teamsAreLoading }"
      >
        <div>
          <client-only>
            <carousel
              class="tournaments-tabs"
              rewind
              :dots="false"
              :nav="false"
              auto-width
            >
              <list
                :game_id="this.$route.query.gameId || currentGameID"
                :game_size="this.$route.query.teamSizeId"
                :page="this.$route.query.page"
              />
              <!-- <tournament-tab-button
                v-for="(game,i) in games"
                :key="i"
                :value="filtersParams.gameId"
                :item="game"
                :v-value="game.id"
                :on-click="() => setFilterKey(game.id, 'gameId')"
              />  -->
            </carousel>
          </client-only>

          <pagination
            :page="+this.$route.query.page"
            :total="teams.last_page"
            :set-page="(page) => updateFilters({ page })"
          />
        </div>
      </loader>
    </div>
  </div>
</template>

<script>
const carousel = () => (process.browser ? import('vue-owl-carousel') : null);
import TournamentTabButton from 'components/BrowseTournaments/TournamentTabButton';
import List from 'components/Profile/JoinedTournaments/List';

import Pagination from 'components/Pagination';
import Loader from 'components/Loader.vue';
import gameFilter from 'mixins/gameFilter';
import { APP_URL } from 'configs/config';

export default {
  name: 'ProfileTournament',
  components: {
    Pagination,
    Loader,
    TournamentTabButton,
    List,
    carousel,
  },
  mixins: [gameFilter],
  middleware: ['hideHeader'],
  data() {
    return {
      currentGameID: 1,
    };
  },
  mounted() {},
  head() {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Tournament',
      link: [
        {
          rel: 'canonical',
          href: route,
        },
      ],
    };
  },
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

@media only screen and (max-width: $mobile-width) {
  .tournaments-tabs {
    padding: 10px 0;
  }
}
.tournament-nav {
  margin: 32px 0;
  &__list {
    display: flex;
    font-size: 20px;
    line-height: 1.2;
    background: $app-background;
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
      background: $app-background;
      clip-path: polygon(10% 0, 95% 0, 100% 20%, 90% 100%, 5% 100%, 0 80%);
    }
  }
}
</style>
