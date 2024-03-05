<template>
  <div
    v-if="items"
    class="tournaments-featured"
  >
    <large-tournament-card
      v-for="tournament in items"
      :key="tournament.id"
      :item="tournament"
    />
  </div>
</template>

<script>
import LargeTournamentCard from 'components/CardsGrid/cards/tournament/LargeTournamentCard';
export default {
  name: 'TournamentsGridFeatured',
  components: {
    LargeTournamentCard,
  },
  props: {
    items: {
      type: Array,
      default: null,
    },
  },
};
</script>

<style lang="scss" scoped>
.tournaments-featured {
  margin: 0 -4px;
}
</style>
