<template>
  <div class="tournament-games">
    <div class="games-title">
      {{ $t('Choose your game') }}
    </div>
    <loader
      :loading="loading"
      :overlay="false"
      class="games-loader"
    >
      <cards-grid
        type="games-grid"
        :items="games"
      />
    </loader>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
const gameModule = createNamespacedHelpers('game');
import Loader from 'components/Loader.vue';
import CardsGrid from 'components/CardsGrid';

export default {
  name: 'Tournaments',
  components: {
    Loader,
    CardsGrid
  },
  computed:{
    ...gameModule.mapState(['games','gamesStatus']),
    loading () {
      return this.gamesStatus === STATE_STATUSES.PENDING;
    }
  },
  created () {
    this.getGames();
  },
  methods:{
    ...gameModule.mapActions([
      'getGames'
    ])
  }
};
</script>

<style lang="scss" scoped>
  .tournament-games{
    padding: 84px 138px;

    &::v-deep   .loader-spinner-wrapper{
      min-height: 300px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  }

  .games-title{
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    font-size: 42px;
    line-height: 59px;
    color: #A1AFD3;
    text-transform: capitalize;
  }
  .games-loader{
    margin-top: 20px;
  }
</style>
