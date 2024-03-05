<template>
  <v-dialog
    v-model="dialog"
    fullscreen
    hide-overlay
    @input="closeModal"
  >
    <div class="team-details__wrap">
      <div class="team-details__content">
        <team-rank
          :ranks="ranks"
          :current-rank="currentRank"
          :info="info"
          :total-rank="totalRank"
          :progress-value="progressValue"
        />
        <info-team
          :info="info"
          :total-rank="totalRank"
          :current-rank="currentRank"
          :progress-value="progressValue"
        />
        <team-members />
        <cross
          class="close-btn"
          @click.native="closeModal"
        />
      </div>
    </div>
    <v-dialog />
  </v-dialog>
</template>

<script>
import TeamRank from '@/components/teamDetails/TeamRank';
import InfoTeam from '@/components/teamDetails/InfoTeam';
import iconBronze from '~/static/images/badges-rank-bronze.png';
import iconSilver from '~/static/images/badges-rank-silver.png';
import iconGold from '~/static/images/badges-rank-gold.png';
import iconWhiteGold from '~/static/images/badges-rank-gold-white.png';
import iconNaVi from '~/static/images/navi.png';
import TeamMembers from '@/components/teamDetails/teamMembers/';
import Cross from '../svgIcons/Cross';
import { createNamespacedHelpers } from 'vuex';
const { mapMutations, mapState } = createNamespacedHelpers('team');

export default {
  name: 'TeamDetails',
  components: {
    Cross,
    TeamMembers,
    InfoTeam,
    TeamRank,
  },
  data: () => ({
    dialog: true,
    currentRank: 0,
    totalRank: 0,
    info: {
      title: '',
      totalWins: 0,
      pointsEarned: 0,
      winRatio: 0,
      teamList: 0,
      icon: iconNaVi,
    },
    ranks: [
      {
        icon: iconBronze,
        status: 'bronze',
        xp: 500,
      },
      {
        icon: iconBronze,
        status: 'bronze',
        xp: 1000,
      },
      {
        icon: iconSilver,
        status: 'silver',
        xp: 1500,
      },
      {
        icon: iconGold,
        status: 'gold',
        xp: 2000,
      },
      {
        icon: iconWhiteGold,
        status: 'white gold',
        xp: 2500,
      },
    ],
  }),
  computed: {
    ...mapState(['activeTeam']),
    progressValue() {
      return (this.currentRank * 100) / this.totalRank;
    },
  },
  mounted() {
    this.info.title = this.activeTeam.name;
    this.info.icon = this.activeTeam.avatar_url;
    this.info.totalWins = this.activeTeam.total_win;
    this.info.pointsEarned = this.activeTeam.points_earned;
    this.info.winRatio = this.activeTeam.win_ratio;
    this.info.teamList = this.activeTeam.team_list;
    this.currentRank = this.activeTeam.current_rank;
    this.totalRank = this.activeTeam.total_rank;
  },
  methods: {
    ...mapMutations(['setActiveTeam']),
    closeModal() {
      this.$router.push({
        query: {
          ...this.$route.query,
          teamId: undefined,
        },
      });
    },
    updateActiveTeam() {
      const team = this.teams.find(({ team_id }) => team_id === this.teamId);
      this.setActiveTeam(team);
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";

.v-dialog__content::v-deep {
  .v-dialog {
    overflow: auto;
  }
}

.team-details {
  &__wrap {
    background: $app-background;
    padding: 75px 0 143px;
  }
  &__content {
    margin: 0 auto;
    max-width: 1100px;
    position: relative;
    &::v-deep {
      .main-heading {
        font-size: 56px;
        line-height: 1.06;
        font-weight: 900;
        color: $text-primary-color;
      }
    }
    .close-btn {
      position: absolute;
      right: -43px;
      top: -27px;
      width: 43px;
      height: 43px;
      cursor: pointer;
    }
  }
}

@media only screen and (max-width: $mobile-width) {
  .team-details__content {
    padding: 0 20px;

    .close-btn {
      right: 32px;
      top: 0;
      width: 24px;
      height: 24px;
    }
  }
}
</style>
