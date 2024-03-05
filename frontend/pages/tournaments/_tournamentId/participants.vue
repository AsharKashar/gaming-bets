<router>
  {
    name: 'tournamentParticipants',
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="participants__wrap">
    <div
      v-if="currentTournament.tournament_size.teams_actual_count"
      class="participants__inner"
    >
      <h2 class="participants__heading">
        <b>{{ currentTournament.tournament_size.teams_actual_count }}/{{ currentTournament.tournament_size.teams_count }}</b>
        {{ isSolo ? 'Players Joined' : 'Teams Joined' }}
      </h2>
      <loader
        :loading="load"
        :overlay="false"
        :center="true"
        :height="200"
        class="participants__wrap"
      >
        <participants-grid
          v-if="currentTournamentTeam.data && currentTournamentTeam.data.length"
          :participants="currentTournamentTeam.data"
          :solo="isSolo"
        />
      </loader>
      <pagination
        class="participants__pagination"
        :page="currentTournamentTeam.current_pafe"
        :total="currentTournamentTeam.last_page"
        :set-page="newPage => setPage(newPage)"
      />
    </div>
    <not-participants v-else />
  </div>
</template>

<script>
import Loader from 'components/Loader';
import Pagination from 'components/Pagination';
import { createNamespacedHelpers } from 'vuex';
import ParticipantsGrid from 'components/CardsGrid/grids/ParticipantsGrid';
import NotParticipants from 'components/tournaments/participants/NotParticipants';

import { APP_URL } from 'configs/config';
const { mapState, mapActions } = createNamespacedHelpers('tournament');

export default {
  name: 'Participants',
  components: {NotParticipants, ParticipantsGrid, Pagination, Loader},
  middleware: ['hideHeader'],
  data: () => ({
    page: 1,
    load: false,
  }),
  computed: {
    ...mapState(['currentTournament', 'currentTournamentTeam']),
    isSolo() {
      return this.currentTournament.team_size.size === 1;
    },
  },
  mounted() {
    this.getTeam();
  },
  methods: {
    ...mapActions(['getCurrentTournamentTeam']),
    setPage(page) {
      this.page = page;
      this.getTeam();
    },
    async getTeam() {
      this.load = true;
      try {
        await this.getCurrentTournamentTeam({page: this.page});
      } finally {
        this.load = false;
      }
    }
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Participants',
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
