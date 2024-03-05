<template>
  <div
    ref="wrap"
    class="wrap--game-tournament"
  >
    <div class="filters-list">
      <game-modes
        :toggle-filter="(f, o) => toggleFilter(f, o, true)"
        :game-mode="availableFilters.gameMode"
        :load-tournament="loadTournament"

        :active-mode="+filtersParams.gameMode"
      />

      <tournaments-filters
        :toggle-filter="(f, o) => toggleFilter(f, o, true)"
        :disabled-filter="loadTournament"
        :available-filters="availableFilters"
        :filters-params="filtersParams"
      />
      <loader
        :loading="loadTournament || !filtersReady"
        :overlay="false"
        :center="true"
        height="200px"
      >
        <div
          ref="tournamentsCount"
          class="tournaments-count"
          v-text="tournamentsCount"
        />

        <tournaments-list
          :tournaments="tournaments.data"
          :current-page="currentPage"
        />

        <pagination
          :page="tournaments.current_page"
          :total="tournaments.last_page"
          :set-page="(page) => setPage(page, $refs.wrap.offsetTop, true)"
        />
      </loader>
    </div>
  </div>
</template>

<script>
import TournamentsFilters from 'components/tournamentWizard/parts/TournamentsFilters';
import TournamentsList from 'components/tournamentWizard/parts/TournamentsList';
import GameModes from 'components/tournamentWizard/parts/GameModes';
import mixinFilterRout from '@/mixins/mixinFilterRout';
import { STATE_STATUSES } from 'helpers/constants';
import { createNamespacedHelpers } from 'vuex';
import {APP_URL} from 'configs/config';
const tournamentModule = createNamespacedHelpers('tournament');
const gameModule = createNamespacedHelpers('game');
import Pagination from 'components/Pagination';
import Loader from 'components/Loader';

export default {
  name: 'GameTournaments',
  components: {
    Loader,
    Pagination,
    GameModes,
    TournamentsFilters,
    TournamentsList,
  },
  middleware: ['hideHeader'],
  mixins: [mixinFilterRout],
  async asyncData({store, route}) {
    const { gameId } = route.params;
    await store.dispatch('game/getCurrentGame', gameId);
    await store.dispatch('tournament/getTournamentFilters', gameId);
    const params = {
      page: 1,
      perPage: 8,
      ...route.query,
      gameId,
    };
    await store.dispatch('tournament/getTournaments', {params, commit: 'setTournaments'});
    return ({
      initFilter: route.query
    });
  },
  data: () => ({
    showModal: false,
  }),
  computed: {
    ...tournamentModule.mapState({
      loadTournament: ({ tournamentsStatus }) => tournamentsStatus === STATE_STATUSES.PENDING,
      filtersReady: ({ tournamentFiltersStatus }) => tournamentFiltersStatus === STATE_STATUSES.READY,
      availableFilters: ({ availableFilters }) => availableFilters,
      tournaments: ({ tournaments }) => tournaments,
    }),
    tournamentsCount() {
      const to = this.tournaments.to || 0;
      const all = this.tournaments.total || 0;
      return `Results ${to} of ${all}`;
    },
    currentPage() {
      return +this.filtersParams.page || 1;
    },
  },
  beforeDestroy() {
    this.setCurrentGame({});
  },
  methods: {
    ...gameModule.mapMutations(['setCurrentGame']),
    ...tournamentModule.mapActions(['getTournaments']),
    callbackFilter(filter) {
      this.getTournaments({
        params:{
          page: 1,
          perPage: 8,
          ...filter,
          gameId: this.$route.params.gameId,
        },
        commit: 'setTournaments'}
      );
    },
  },
  head() {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Games',
      meta: [
        {
          vmid: 'canonical',
          name: 'canonical',
          href: route
        },
        {
          name: 'robots',
          content: 'noindex'
        }
      ],
    };
  }
};
</script>

<style lang="scss" scoped>
  @import "~assets/styles/sizes.scss";

  ::v-deep {
    .pagination-container {
      margin: 6px 0 274px auto;
    }
  }

  .tournaments-count {
    margin-bottom: 15px;
    font-weight: 800;
  }

  .wrap--game-tournament {
    max-width: 1110px;
    margin: 0 auto;
  }
  @media all and (max-width: $tablet-small-width) {
    .wrap--game-tournament {
      padding: 0 20px;
    }
  }

  @media only screen and (max-width: $tablet-large-width) {
    ::v-deep {
      .pagination-container {
        margin-bottom:50px;
      }
    }
  }
</style>
