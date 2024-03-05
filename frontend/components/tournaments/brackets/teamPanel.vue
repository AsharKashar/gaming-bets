
<template>
  <div class="team-wrapper">
    <div class="team">
      <img
        v-if="match.team_1==match.hosted_by"
        src="~/static/images/brackets/host.svg"
        alt="host"
        class="host-img "
      >
      <img
        v-if="match.team_2==match.hosted_by"
        src="~/static/images/brackets/host.svg"
        alt="host"
        class="host-img bottom"
      >
      <v-expansion-panels>
        <team
          class="match__team upper_team"
          :team="match.team_a"
          :border-top="true"
          :round="match.round"
          :winner="match.winner_id"
        />
        <team
          class="match__team lower_team"
          :team="match.team_b"
          :border-top="false"
          :round="match.round"
          :winner="match.winner_id"
        />
      </v-expansion-panels>
    </div>
  </div>
</template>
<script>
import Team from './team.vue';
export default {
  components: {
    Team,
  },
  props: {
    match: {
      type: Object,
      default: () => ({})
    },
  },
};
</script>

<style lang="scss" scoped>
.brackets-wrapper {
  .team-wrapper {
    .team {
      .bottom {
        top: 65px !important;
      }
    }
  }
}
</style>
