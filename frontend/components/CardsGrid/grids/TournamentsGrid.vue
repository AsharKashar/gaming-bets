<template>
  <div
    v-if="items"
    class="tournaments-grid"
  >
    <small-tournament-card
      v-for="tournament in items"
      :key="tournament.id"
      :item="tournament"
    />
  </div>
</template>

<script>

import SmallTournamentCard from 'components/CardsGrid/cards/tournament/SmallTournamentCard';
export default {
  name: 'TournamentsGrid',
  components: {
    SmallTournamentCard
  },
  props: {
    items: {
      type: Array,
      default: null,
    }
  }
};
</script>

<style scoped lang="scss">
.tournaments-grid {
  display: flex;
  flex-wrap: wrap;

  margin: 0 -16px;
}
</style>