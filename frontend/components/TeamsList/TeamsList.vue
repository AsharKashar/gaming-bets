<template>
  <div class="teams-block">
    <team-list-header :teams-count="teamsList.length" />
    <div class="teams-list">
      <team-card
        v-for="(team,i) in teamsList"
        :key="i"
        :team="team"
      />
    </div>
  </div>
</template>

<script>
import TeamListHeader from './TeamListHeader';
import TeamCard from './TeamCard';

export default {
  name: 'TeamsList',
  components: {
    TeamListHeader,
    TeamCard
  },
  props: {
    teamsList: {
      type: Array,
      default: () => ([])
    }
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .teams-block{
    width: 100%;
  }

  .teams-list{
    margin-top: 12px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  @media only screen and (max-width: $tablet-small-width) {
    .teams-block{
      padding:0;
    }
    .teams-list{
      overflow: auto;
      justify-content: center;
    }
  }

  @media only screen and (min-width: $desktop-width) {
    .teams-block{
      padding-right: 15%;
    }
  }

</style>
