<template>
  <div class="match-team-info">
    <match-team-item
      :is-right="true"
      :name="teamFirst.name"
      :avatar-url="teamFirst.avatar_url"
      :rank="teamFirst.current_rank || 0"
      :is-won="teamFirst.team_id === winnerTeamId"
      :is-host="teamFirst.team_id === hostedTeamId"
    />
    <div
      v-if="false"
      class="match-team-info__score"
    >
      <match-kills-item :match-result-kills="+teamFirst.score" />
      <span>:</span>
      <match-kills-item :match-result-kills="+teamSecond.score" />
    </div>
    <match-team-item
      :is-right="false"
      :name="teamSecond.name"
      :avatar-url="teamSecond.avatar_url"
      :rank="teamSecond.current_rank"
      :is-won="teamSecond.team_id === winnerTeamId"
      :is-host="teamSecond.team_id === hostedTeamId"
    />
  </div>
</template>

<script>
import MatchTeamItem from 'components/MatchTeamItem';
import MatchKillsItem from 'components/tournaments/matches/MatchKillsItem';
export default {
  name: 'MatchTeams',
  components: {MatchKillsItem, MatchTeamItem},
  props: {
    teamFirst: {
      type: Object,
      default: () => ({}),
    },
    teamSecond: {
      type: Object,
      default: () => ({}),
    },
    winnerTeamId: {
      type: Number,
      default: null,
    },
    hostedTeamId: {
      type: Number,
      default: null,
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/assets/styles/sizes';
@import '~/assets/styles/colors';

.match-team {
  &-item {
    max-width: 40%;
    flex: 0 0 40%;
    width: 100%;
    padding: 0 15px 10px;
  }

  &-info {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: center;
    padding-bottom: 18px;

    &__score {
      justify-content: space-between;
      width: 100%;
      padding: 0 40px 10px;
      display: flex;
      align-items: center;
      max-width: 20%;
      flex: 0 0 20%;
      text-align: center;
      font-size: 32px;
      line-height: 1.2;
      color: $text-secondary-color;
    }
  }
}

@media all and (max-width: 1200px) {
  .match-team {
    &-item {
      padding: 0 5px 10px;
    }
    &-info__score {
      padding: 0 10px;
    }
  }
}
</style>
