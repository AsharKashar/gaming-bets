<template>
  <div class="tournaments-list">
    <template>
      <cards-grid
        v-if="isFeatureTournament"
        type="tournaments-featured"
        :items="tournaments.slice(0, 2)"
      />
      <cards-grid
        type="tournaments-grid"
        :items="tournamentsCardItem"
      />
    </template>
  </div>
</template>

<script>
import CardsGrid from 'components/CardsGrid';

export default {
  name: 'TournamentsList',
  components: {
    CardsGrid,
  },
  props: {
    tournaments: {
      type: Array,
      default: () => ([])
    },
    currentPage: {
      type: Number,
      required: true,
    }
  },
  computed: {
    isDesktop() {
      return this.$vuetify.breakpoint.width > 767;
    },
    isFeatureTournament() {
      return this.currentPage === 1 && this.isDesktop;
    },
    tournamentsCardItem() {
      if (this.isFeatureTournament) {
        return  this.tournaments.slice(2);
      }
      return this.tournaments;
    },
  },
};
</script>
