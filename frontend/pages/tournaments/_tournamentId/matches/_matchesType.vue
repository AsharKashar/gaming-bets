<router>
{
  name: 'matchesChild',
  meta:{
    savePosition:true
  }
}
</router>
<template>
  <div class="match-child">
    <loader
      :center="true"
      height="300px"
    >
      <cards-grid
        type="MatchGrid"
        :data="{
          tournamentId,
          matchesType: params.matchesType,
          userTeamId,
        }"
        :items="matchesItems"
      />
      <pagination
        class="match-pagination"
        :page="matchesPagination.current_page"
        :total="matchesPagination.last_page"
        :is-right="true"
        :set-page="setPage"
      />
    </loader>
  </div>
</template>

<script>
import CardsGrid from 'components/CardsGrid/CardsGrid';
import Pagination from 'components/Pagination';
import { createNamespacedHelpers } from 'vuex';
import {STATE_STATUSES} from 'helpers/constants';
import Loader from 'components/Loader';
const { mapState, mapActions } = createNamespacedHelpers('matches');

export default {
  name: 'MatchesType',
  components: {Loader, Pagination, CardsGrid},
  async asyncData({store, route}) {
    const { tournamentId, matchesType } = route.params;
    const data = {
      tournamentId,
      params: { matchesType }
    };

    await store.dispatch('matches/getMatches', data);
    return (data);
  },
  computed: mapState({
    matchesItems: ({matches}) => matches.items,
    matchesPagination: ({matches}) => matches.pagination,
    userTeamId: ({matches}) => matches.user_team_id,
    loader: ({matchStatus}) => matchStatus === STATE_STATUSES.READY
  }),
  methods: {
    ...mapActions(['getMatches']),
    setPage(page) {
      this.$set(this.params, 'page', page);
      this.getMatches({
        tournamentId: this.tournamentId,
        params: this.params,
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.match-pagination {
  margin: 77px 0 60px;
}
</style>
