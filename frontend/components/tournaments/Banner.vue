<template>
  <div class="tournament-banner">
    <div class="tournament-banner__col tournament-banner__col--left">
      <div
        class="banner__wrap"
        :style="`background-image:url(${imgSrc});background-size:cover;background-position:center;`"
      >
        <v-img
          class="banner"
          max-width="100%"
          :src="imgSrc"
        />
      </div>
    </div>
    <div class="tournament-banner__col tournament-banner__col--right">
      <side-bar
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
          {{ dayStart }}-{{ dayFinished }}
        </div>
        {{ monthFinished }}
      </div>
    </div>
  </div>
</template>

<script>
import SideBar from 'components/tournaments/SideBar';
import dayjs from 'dayjs';
export default {
  name: 'TournamentsBanner',
  components: {SideBar},
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
    maxTeam(){
      return this.currentTournament.tournament_size.teams_count;
    },
    teamJoinedTotal(){
      return this.currentTournament.tournament_size.teams_actual_count;
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
