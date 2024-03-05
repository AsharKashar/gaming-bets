<template>
  <div>
    <div v-if="(round==2 || round==3 || round==4) && winner==null">
      <demi-team :border-top="borderTop" />
    </div>
    <div v-else>
      <v-expansion-panel>
        <v-expansion-panel-header>
          <div class="team-info">
            <div class="team-img">
              <img
                src="~/static/images/brackets/team-icon.svg"
                alt
                class="team-img"
              >

              <!-- <img :src="team.avatar_url" alt class="team-img" /> -->
            </div>
            <div class="team-name-match">
              <v-tooltip
                v-model="show"
                top
              >
                <template v-slot:activator="{ on, attrs }">
                  <p
                    v-bind="attrs"
                    v-on="on"
                  >
                    {{ team.name }}
                  </p>
                </template>
                <span>{{ team.name }}</span>
              </v-tooltip>
            </div>
            <img
              v-if="winner==team.team_id"
              src="~/static/images/brackets/winner-icon.svg"
              alt="winner icon"
              class="winner-icon"
            >
            <div
              class="team-points"
              :class="{'upper-team':borderTop}"
            >
              <p>{{ round }}</p>
            </div>
          </div>
        </v-expansion-panel-header>
        <v-expansion-panel-content class="team-member pa-0">
          <team-member
            v-for="member in team.members"
            :key="member"
            :member="member"
          />
        </v-expansion-panel-content>
      </v-expansion-panel>
    </div>
  </div>
</template>

<script>
import TeamMember from './teamMember.vue';
import DemiTeam from './demiTeam.vue';

export default {
  components: {
    TeamMember,
    DemiTeam
  },
  props: {
    borderTop: {
      type: Boolean,
    },
    team: {
      type: Object,
      default: () => ({})
    },
    round: {
      type: String,
      default: ''
    },
    winner: {
      type: String,
      default: ''
    },
  },
  data() {
    return {};
  },

  methods: {},
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

@media screen and (max-width: 1120px) {
  .winner-icon {
    display: none;
  }
}
@media screen and (max-width: 1024px) {
  .winner-icon {
    display: inline-block;
  }
}
.wating-winner {
  margin: 0 0 0 2px;
  width: 80% !important;
}
.team-info {
  .team-name-match {
    font-size: 12px;
  }
}
</style>
