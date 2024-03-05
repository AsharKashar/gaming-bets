<template>
  <div class="match-wrapper">
    <v-row>
      <v-col
        md="6"
        no-gutters
        class="navigation-bracket"
      >
        <group-navigation
          :groups="groups"
          :disabled="false"
          @goLink="goLink"
        />
      </v-col>
      <v-col
        md="6"
        no-gutters
        class="navigation-bracket"
      >
        <group-navigation
          :groups="finalGroups"
          :disabled="true"
          @goLink="goLink"
        />
      </v-col>
    </v-row>
    <v-row>
      <div class="matches">
        <router-view />
      </div>
    </v-row>
  </div>
</template>

<script>
import GroupNavigation from './groupNavigation.vue';
import { createNamespacedHelpers } from 'vuex';
const tournamentModule = createNamespacedHelpers('tournament');
export default {
  components: {
    GroupNavigation,
  },
  data() {
    return {
      groups: [{ id: 1, name: 'Group A' }],

      finalGroups: [
        { id: 1, name: 'QuarterFinal' },
        { id: 1, name: 'Semifinal' },
        { id: 1, name: 'Final' },
        { id: 1, name: 'Champion' },
      ],
    };
  },
  computed: {
    ...tournamentModule.mapState(['brackets']),
  },
  methods: {
    goLink(id) {
      this.$router.push(
        `/tournaments/${this.$route.params.tournamentId}/brackets/group/${id}`
      );
    },
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.matches {
  width: 100%;
}
.navigation-bracket {
}
</style>
