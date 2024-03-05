<template>
  <div class="tournaments-container">
    <loader
      :loading="loading"
      :overlay="false"
      :center="true"
      height="300px"
    >
      <title-search-bar
        title="Challenges"
        subtitle="Head to head matches where you pick the game, rules and prize."
        @setSearchText="(val) => setFilterKey(val, 'name')"
      />

      <tournaments-filters
        class="challenge-filter"
        :toggle-filter="toggleFilter"
        :disabled-filter="false"
        :available-filters="availableFilters"
        :filters-params="filtersParams"
      />

      <client-only>
        <carousel
          class="tournaments-tabs"
          rewind
          :dots="false"
          :nav="false"
          auto-width
        >
          <tournament-tab-button
            v-for="(game,i) in games"
            :key="i"
            :value="filtersParams.gameId"
            :item="game"
            :v-value="game.id"
            :on-click="() => setFilterKey(game.id, 'gameId')"
          />
        </carousel>
      </client-only>
      <inline-card />
      <div class="pagination">
        <pagination
          :page="filtersParams.page"
          :total="3"
          :set-page="(page) => setPage(page)"
          :style-second="true"
        />
      </div>
    </loader>
  </div>
</template>

<script>
import TitleSearchBar from 'components/HomePage/FeaturesGames/TitleSearchBar';
import TournamentTabButton from 'components/BrowseTournaments/TournamentTabButton';
import InlineCard from './inlineCard.vue';
import Loader from 'components/Loader.vue';
import Pagination from 'components/Pagination';
import mixinFilterRout from '@/mixins/mixinFilterRout';
import { STATE_STATUSES } from 'helpers/constants';
import { createNamespacedHelpers } from 'vuex';
import {get} from 'lodash';
import TournamentsFilters from 'components/tournamentWizard/parts/TournamentsFilters';

const carousel = () => process.browser ? import ('vue-owl-carousel') : null;
const gameModule = createNamespacedHelpers('game');

export default {
  components: {
    TournamentsFilters,
    TitleSearchBar,
    TournamentTabButton,
    InlineCard,
    Loader,
    carousel,
    Pagination

  },
  mixins: [mixinFilterRout],
  data: () => ({
    availableFilters: { repeat: [{name: 'Daily', id: 1}], gameType: [{id:1,name:'Squads'}], platform: [{id:1,name:'Xbox'},{id:2,name:'Playstation'},{id:3,name:'PC'},{id:4,name:'All platforms'}] }
  }),
  computed: {
    ...gameModule.mapState(['games', 'gamesStatus']),
    initFilter() {
      return ({
        page: 1,
        gameId: get(this,'games[0].id'),
      });
    },
    loading() {
      return (
        this.gamesStatus === STATE_STATUSES.PENDING ||
        this.tournamentFiltersStatus === STATE_STATUSES.PENDING
      );
    },
  },
  methods: {
    callbackFilter(filter) {
      console.log(filter);
    }
  }
};
</script>

<style lang='scss' scoped>
@import "~/assets/styles/sizes";
 .pagination {
    position: relative;
    float: right;
    padding-top: 1.5em;
    padding-right: 1em;
  }
.tournaments-container::v-deep .col-left {
  flex-basis: 70%;
}
.tournaments-container {
  display: flex;
  flex-direction: column;

  .tournaments-tabs {

    cursor: pointer;
    &::v-deep .owl-item {
      &:last-child .tab_button {
        border: none;
      }
    }
  }
}

.challenge-filter {
  margin-bottom: 30px;
}

@media only screen and (min-width: $desktop-width) {
  .tournaments-container::v-deep .col-left {
    flex-basis: 70%;
    .home-subtitle {
      font-size: 20px;
    }
  }
  .tournaments-container::v-deep .col-right {
    flex-basis: 30%;
  }
}

</style>
