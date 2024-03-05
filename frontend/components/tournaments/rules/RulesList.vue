<template>
  <loader
    :loading="load"
    :overlay="false"
    :center="true"
    :height="200"
    class="rules-list__wrap"
  >
    <v-expansion-panels
      accordion
      flat
    >
      <v-expansion-panel
        v-for="({name, body}, i) in currentTournamentRules"
        :key="i"
      >
        <v-expansion-panel-header
          disable-icon-rotate
          color="#212652"
        >
          <template #default="{open}">
            <div class="panel-title">
              {{ name }}
            </div>
            <div class="panel-icon">
              <svg-icon :name="open ? 'minus' : 'plus'" />
            </div>
          </template>
          <template #actions>
            <span />
          </template>
        </v-expansion-panel-header>
        <v-expansion-panel-content color="#212652">
          <div v-html="body" />
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </loader>
</template>

<script>
import Loader from 'components/Loader';
import {createNamespacedHelpers} from 'vuex';
import SvgIcon from 'components/svgIcons/SvgIcon';
const { mapActions, mapState } = createNamespacedHelpers('tournament');
export default {
  name: 'RulesList',
  components: {SvgIcon, Loader},
  data: () => ({
    load: false,
  }),
  computed: mapState(['currentTournamentRules']),
  mounted() {
    this.getRules();
  },
  methods: {
    ...mapActions(['getCurrentTournamentRules']),
    async getRules() {
      this.load = true;
      try {
        await this.getCurrentTournamentRules();
      } finally {
        this.load = false;
      }
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors.scss";

.v-expansion-panel {
  margin-bottom: 2px;
  &-header {
    color: $text-primary-color;
    padding: 20px 24px;
    font-weight: 900;
    font-size: 20px;
    line-height: 1.1;
    border-radius: 0;
    min-height: 64px;
    .panel-title {
      max-width: calc(100% - 20px);
      flex: 0 0 calc(100% - 20px);
    }
    .panel-icon {
      max-width: 20px;
      flex: 0 0 20px;
      height: 20px;
      display: flex;
      align-items: center;
      overflow: hidden;
    }
  }
}
</style>
