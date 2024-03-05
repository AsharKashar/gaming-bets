<template>
  <div class="game-nav">
    <tournament-tab-button
      v-for="(game, i) in games"
      :key="i"
      :value="currentGame.id"
      :item="game"
      :v-value="game.id"
      name="test-radio"
      :on-click="
        () => {
          updateFilters({ gameId: game.id, page: 1, gametab });
        }
      "
    />
  </div>
</template>

<script>
import gameFilter from '@/mixins/gameFilter';
import TournamentTabButton from 'components/BrowseTournaments/TournamentTabButton';

export default {
  components: {
    TournamentTabButton,
  },
  mixins: [gameFilter],
  computed: {
    gametab() {
      return this.$route.name;
    },
  },
};
</script>

<style lang="scss" scoped>
.game-nav {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
}
</style>
