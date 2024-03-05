<template>
  <div
    class="game-mode"
  >
    <h2
      v-ripple
      @click="show = !show"
    >
      Game Mode Rules
    </h2>
    <v-expand-transition>
      <div
        v-if="show"
        class="game-mode__list"
      >
        <game-mode-list />
      </div>
    </v-expand-transition>
  </div>
</template>

<script>
import GameModeList from './GameModeList';
import { createNamespacedHelpers } from 'vuex';
const { mapMutations } = createNamespacedHelpers('gameRules');
const localesModule = createNamespacedHelpers('locales');

export default {
  name: 'GameRules',
  components: {GameModeList},
  props: {
    data: {
      type: Object,
      default: () => ({})
    },
  },
  data: () => ({
    show: true,
  }),
  created() {
    this.setGameModes(this.data.gameModes);
    this.setLocales(this.data.locales);
  },
  methods: {
    ...mapMutations(['setGameModes']),
    ...localesModule.mapMutations(['setLocales']),
  }
};
</script>

<style scoped lang="scss">
.game-mode {
  h2 {
    margin: 0;
    padding: 15px;
    cursor: pointer;
    font-weight: 800;
  }
  &__list {
    padding: 0 15px 20px;
  }
}
</style>
