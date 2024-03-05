<template>
  <div class="teams-list">
    <tournament-team-card
      v-for="team in teams"
      :key="team.team_id"
      :img-src="team.avatar_url"
      :title="team.name"
      :class="{active: team.team_id === activeTeam.team_id}"
      @click.native="setActiveTeam(team)"
    />
  </div>
</template>

<script>
import TournamentTeamCard from 'components/CardsGrid/cards/tournament/TournamentTeamCard';

export default {
  name: 'TournamentTeamGrid',
  components: { TournamentTeamCard  },
  props: {
    teams: {
      type: Array,
      required: true
    }
  },
  data: () => ({
    activeTeam: {},
  }),
  methods: {
    setActiveTeam(team) {
      if (this.activeTeam.team_id === team.team_id) {
        this.activeTeam = {};
      } else {
        this.activeTeam = team;
      }
      this.$emit('setActiveTeam', this.activeTeam);
    },
  }
};
</script>

<style lang="scss" scoped>
.teams-list {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -10px 17px;
}
</style>
