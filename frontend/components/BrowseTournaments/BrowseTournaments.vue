<template>
  <div
    ref="wrap"
    class="tournaments-container"
  >
    <title-search-bar
      title="Browse Tournaments"
      subtitle="Select a game and then choose how you want to play."
      @setSearchText="(s) => setFilterKey(s, 'name')"
    />
    <loader
      :loading="loadingGame"
      :overlay="false"
      :center="true"
      height="300px"
    >
      <client-only>
        <carousel
          class="tournaments-tabs"
          rewind
          :dots="false"
          :nav="false"
          auto-width
        >
          <tournament-tab-button
            v-for="game in games"
            :key="game.id"
            :item="game"
            :disabled="loadingFilter"
            :v-value="game.id"
            :value="filtersParams.gameId"
            :on-click="() => setGameFilter(game.id)"
          />
        </carousel>
      </client-only>
      <tournaments-filters
        class="tournament-filter"
        :toggle-filter="toggleFilter"
        :disabled-filter="loadingFilter"
        :available-filters="availableFilters"
        :add-to-default-filter="[{title: 'Game mode', name: 'gameMode'}]"
        :filters-params="filtersParams"
      />
    </loader>
    <loader
      :loading="loadingTournament"
      :overlay="false"
      class="tournaments-loader"
      :center="true"
      height="500"
    >
      <tournament-list
        :tournaments="tournaments.data"
        :game-image="currentGameItem.image_public_url"
      />
      <pagination
        :page="tournaments.current_page"
        :total="tournaments.last_page"
        :set-page="(page) => setPage(page, $refs.wrap.offsetTop)"
        :style-second="true"
      />
    </loader>
  </div>
</template>

<script>
import TitleSearchBar from 'components/HomePage/FeaturesGames/TitleSearchBar';
import TournamentTabButton from './TournamentTabButton';
import Loader from 'components/Loader.vue';
import TournamentList from 'components/BrowseTournaments/TournamentList';
import { get } from 'lodash';
import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
import mixinFilterRout from '@/mixins/mixinFilterRout';
import Pagination from 'components/Pagination';
import TournamentsFilters from 'components/tournamentWizard/parts/TournamentsFilters';

const gameModule = createNamespacedHelpers('game');
const tournamentModule = createNamespacedHelpers('tournament');
const carousel = () => process.browser ? import ('vue-owl-carousel') : null;

export default {
  name: 'BrowseTournaments',
  components: {
    TournamentsFilters,
    Pagination,
    TournamentList,
    carousel,
    TitleSearchBar,
    TournamentTabButton,
    Loader,
  },
  mixins: [mixinFilterRout],
  computed: {
    ...gameModule.mapState({
      games: ({games}) => games,
      loadingGame: ({gamesStatus}) => gamesStatus === STATE_STATUSES.PENDING
    }),
    ...tournamentModule.mapState({
      loadingTournament: ({tournamentsStatus}) => tournamentsStatus === STATE_STATUSES.PENDING,
      loadingFilter: ({tournamentFiltersStatus}) => tournamentFiltersStatus === STATE_STATUSES.PENDING,
      tournaments: ({tournaments}) => tournaments,
      availableFilters: ({availableFilters}) => availableFilters,
    }),
    currentGameItem() {
      return this.games.find((game) => game.id === this.filtersParams.gameId) || {};
    },
    perPage() {
      return this.$vuetify.breakpoint.width > 1600 ? 9 : 8;
    }
  },
  async created() {
    await this.mountData();
  },
  methods: {
    ...gameModule.mapActions(['getGames']),
    ...tournamentModule.mapActions(['getTournamentFilters', 'getTournaments']),
    async mountData() {
      if (!get(this.games, '[0].id')){
        await this.getGames();
      }
      const gameId = get(this.games, '[0].id');
      await this.getTournamentFilters(gameId);
      this.filtersParams = {
        gameId,
        page: 1,
      };

      await this.callbackFilter(this.filtersParams, false);
    },
    async setGameFilter(gameId) {
      await this.getTournamentFilters(gameId);
      this.setFilters({
        gameId,
        page: 1,
      });
    },
    async callbackFilter(filters, isCheckStatus = true) {
      await this.getTournaments({
        params: {
          ...filters,
          per_page: this.perPage
        },
        commit: 'setTournaments',
        isCheckStatus,
      });
    }
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
.tournaments-container::v-deep .col-left {
  flex-basis: 70%;
}
.tournaments-container {
  display: flex;
  flex-direction: column;

  .tournaments-tabs {
    margin-top: 0;
    cursor: pointer;
    &::v-deep .owl-item {
      &:last-child .tab_button {
        border: none;
      }
    }
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .tournaments-container {
    .tournaments-tabs {
      margin-top: 50px;
    }
  }
}

@media only screen and (min-width: $desktop-width) {
  .tournaments-container {
    .tournaments-tabs {
      margin-top: 70px;
    }

    &::v-deep {
      .col-left {
        flex-basis: 70%;
        .home-subtitle {
          font-size: 20px;
        }
      }
      .col-right {
        flex-basis: 30%;
      }
    }
  }
}
</style>
