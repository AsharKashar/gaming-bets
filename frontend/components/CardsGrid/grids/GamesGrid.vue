<template>
  <div class="cutted-arrows-grid">
    <cutted-arrows-card
      v-for="item in items"
      :key="item.id"
      :caption="caption(item)"
      :background="item.image_public_url"
      :cover="item.cover_public_url"
      :disabled="item.tournaments_count<=0"
      @click.native="item.tournaments_count<=0 ? () => {} : selectGame(item.id)"
    />
  </div>
</template>

<script>
import CuttedArrowsCard from '../cards/CuttedArrowsCard';

export default {
  name: 'GamesGrid',
  components: {
    CuttedArrowsCard
  },
  props: {
    items: {
      type: Array,
      default: () => []
    }
  },
  methods: {
    selectGame (gameId) {
      this.$router.push(`tournaments/games/${gameId}`);
    },
    caption (item) {
      const count = item.tournaments_count;

      return count? this.$t(''+ count +' tournaments') : this.$t('comming soon...');
    }
  }
};
</script>

<style lang="scss" scoped>
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .cutted-arrows-grid{
    display: flex;
    flex-direction: row;
    justify-content: center;
    flex-wrap: wrap;
    margin: 0 -8px;
    .cutted-arrows-card {
      width: 100%;
      max-width: 921px;
      padding: 8px;
    }
  }
</style>
