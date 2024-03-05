<template>
  <v-expansion-panels
    focusable
    accordion
  >
    <v-expansion-panel
      v-for="item in typesLink"
      :key="item.type"
    >
      <v-expansion-panel-header> {{ item.name }} </v-expansion-panel-header>
      <v-expansion-panel-content>
        <tournament-options-form
          type="links"
          :item-key="item.type"
          :option="getDataLinks(item.type)"
        >
          <template #formFields="{ option, setFields }">
            <links
              :init-fields="option.data ? option.data[item.type] : []"
              @setOptions="setFields($event)"
            />
          </template>
        </tournament-options-form>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
import Links from '../global-options/options-group/Links';
import TournamentOptionsForm from './TournamentOptionsForm';

const { mapState } = createNamespacedHelpers('tournamentOptions');
const moduleGlobalOptions = createNamespacedHelpers('globalOptions');

export default {
  name: 'TournamentLinks',
  components: {TournamentOptionsForm, Links},
  computed: {
    ...mapState(['links']),
    ...moduleGlobalOptions.mapState({
      typesLink: ({types}) => types.filter(({group}) => group === 'links'),
    }),
  },
  methods: {
    getDataLinks(type) {
      return  this.links.find(({data}) => Object.keys(data)[0] === type) || {};
    },
  },
};
</script>

<style scoped>

</style>
