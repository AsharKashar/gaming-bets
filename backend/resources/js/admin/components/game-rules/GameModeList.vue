<template>
  <v-expansion-panels
    focusable
    accordion
  >
    <v-expansion-panel
      v-for="(gameMode, i) in gameModes"
      :key="i"
    >
      <v-expansion-panel-header>{{ gameMode.name }}</v-expansion-panel-header>
      <v-expansion-panel-content>
        <rule-locale-list
          :init-rules="gameMode.rules"
          :game-mode-id="gameMode.id"
        />
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script>
import RuleLocaleList from './RuleLocaleList';
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('gameRules');
export default {
  name: 'GameModeList',
  components: {RuleLocaleList},
  computed: mapState(['gameModes']),
};
</script>

<style scoped>

</style>
