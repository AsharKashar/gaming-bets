<template>
  <div class="tournament-banner">
    <div class="tournament-banner__col tournament-banner__col--left">
      <div
        class="banner__wrap"
        :style="`background-image:url(${imgSrc});background-size:cover;background-position:center;`"
      />
    </div>
    <div class="tournament-banner__col tournament-banner__col--right">
      <boxfight-sidebar 
        :register-date-finished="regEndDate"
        :max-team="maxTeam"
        :team-joined="currentTournament.teams"
        :team-joined-total="teamJoinedTotal"
        :status="matchStatus"
        class="tournaments-sidebar tournaments-col"
      />
    </div>
    <div class="tournament-banner__col tournament-banner__col--left">
      <h1 class="page-heading">
        {{ title }}
      </h1>
    </div>
    <div class="tournament-banner__col tournament-banner__col--right">
      <div
        class="tournament__date"
      >
        <div class="tournament__date-heading">
          {{ boxFightDate }}
        </div>
        {{ boxFightTime }} Local Time
      </div>
    </div>
  </div>
</template>

<script>
import dayjs from 'dayjs';
import { createNamespacedHelpers } from 'vuex';
const boxfightModule = createNamespacedHelpers('boxfight');
import BoxfightSidebar from './BoxfightSidebar';
export default {
  name: 'TournamentsBanner',
  components: { BoxfightSidebar},
  props: {
    currentTournament: {
      type: Object,
      required: true,
    },
    imgSrc: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
  },
  computed: {
    ...boxfightModule.mapState([  
      'currentBoxFight',
    ]),
    dayStart() {
      return dayjs(this.currentTournament.reg_start_at).format('D');
    },
    dayFinished() {
      return dayjs(this.currentTournament.reg_end_at).format('D');
    },
    monthFinished() {
      return dayjs(this.currentTournament.reg_end_at).format('MMMM');
    },
    regEndDate(){
      return this.currentTournament.reg_end_at;
    },
    matchStatus(){
      return this.currentTournament.status.type === 'registration';
    },
    boxFightDate() {
      return dayjs(this.currentBoxFight.time).format('DD MMM');
    },
    boxFightTime() {
      return dayjs(this.currentBoxFight.time).format('hh : mm a');
    },
    maxTeam(){
      return 0;
    },
    teamJoinedTotal(){
      return 0;
    }
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
.banner {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  &__wrap {
    position: relative;
    width: 100%;
    height: 100%;
  }
}
.page-heading {
  font-size: 48px;
  line-height: .9;
}

.tournament-banner {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -15px 20px;
  &__col {
    width: 100%;
    padding: 0 15px 25px;
    &--left {
      max-width: calc(100% - 285px);
      flex: 0 0 calc(100% - 285px);
    }
    &--right {
      max-width: 285px;
      flex: 0 0 285px;
    }
  }
}

.tournament__date {
  color: $text-secondary-color;
  font-size: 24px;
  font-weight: 800;
  line-height: 1.1;
  &-heading {
    font-size: 56px;
  }
}
</style>
