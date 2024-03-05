<template>
  <div class="tournament-options">
    <h3>Tournament Options</h3>
    <v-expansion-panels
      v-if="!typeLoad"
      accordion
      class="my-2"
    >
      <v-expansion-panel
        v-for="(name, key) in components"
        :key="key"
      >
        <v-expansion-panel-header>
          <b>{{ name }}</b>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <component :is="key" />
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
    <loader :loading="typeLoad" />
  </div>
</template>

<script>
import TournamentLinks from './TournamentLinks';
import TournamentRules from './TournamentRules';
import { createNamespacedHelpers } from 'vuex';
import Loader from '../Loader';

const { mapMutations, mapState } = createNamespacedHelpers('tournamentOptions');
const localesModule = createNamespacedHelpers('locales');

export default {
  name: 'TournamentOptions',
  components: {
    Loader,
    TournamentLinks,
    TournamentRules
  },
  props: {
    data: {
      type: Object,
      default: () => ({}),
    }
  },
  data: () => ({
    components: {
      TournamentLinks: 'Tournament Links',
      TournamentRules: 'Tournament Rules',
    },
  }),
  computed: mapState(['typeLoad']),
  created() {
    const { tournamentOptions, tournamentId, locales } = this.data;
    tournamentOptions.map((el) => {
      this.setDataStore(el.type, el);
    });
    this.setTournamentId(tournamentId);
    this.setLocales(locales);
  },
  methods: {
    ...mapMutations(['addLinks', 'addRules', 'setTournamentId']),
    ...localesModule.mapMutations(['setLocales']),
    setDataStore(type, data) {
      const method = 'add' + type.charAt(0).toUpperCase() + type.slice(1);
      if (this[method]) {
        this[method](data);
      }
    }
  },
};
</script>

<style lang="scss" scoped>
.tournament-options {
  position: relative;
  padding: 15px;
}
</style>
