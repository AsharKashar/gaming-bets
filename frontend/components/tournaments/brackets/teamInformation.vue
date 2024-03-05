<template>
  <div class="team-Info-wrapper">
    <div class="teamInfo">
      <p class="teamInfo__totalTeams">
        Total Teams {{ brackets.groups_information.total_teams }}
      </p>
      <p class="teamInfo__subtitle">
        {{ subtitle }}
      </p>
      <p
        class="teamInfo__groupDetail"
      >
        You are in the Group {{ brackets.groups_information.user_team_prFesent_in_group }} Name of your team {{ brackets.groups_information.user_team_name }}
      </p>
    </div>

    <!-- <Popups></Popups> -->
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const tournamentModule = createNamespacedHelpers('tournament');
export default {
  data() {
    return {
      total: '100 Teams',
      subtitle: 'Joined The Tournament',
      groupDetail: 'You are in the Group A. Name of your team — Lara_3478',
    };
  },
  computed: {
    ...tournamentModule.mapState(['brackets']),
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.team-Info-wrapper {
  padding: 2em 0;
  width: 100%;
  text-align: center;
  .teamInfo {
    font-weight: 900;

    &__totalTeams {
      font-size: 32px;
      line-height: 115%;
      color: #a1afd3;
      font-weight: 900;
      margin-bottom: 10px;
    }

    &__subtitle {
      font-size: 20px;
      line-height: 110%;
      font-weight: 900;
      color: #fff;
      margin: 0;
    }
    &__groupDetail {
      font-size: 16px;
      line-height: 120%;
      font-weight: 900;
      color: #be1338;
      margin-top: 2em;
    }
  }
}

@media screen and (max-width: $tablet-small-width) {
  .team-Info-wrapper {
    padding: 1em;
    text-align: left;
    .teamInfo {
      &__totalTeams {
        font-size: 20px;
        margin-bottom: 5px;
      }

      &__subtitle {
        font-weight: 800;
        font-size: 14px;
      }
      &__groupDetail {
        font-size: 11px;
        margin-top: 1em;
      }
    }
  }
}
</style>
