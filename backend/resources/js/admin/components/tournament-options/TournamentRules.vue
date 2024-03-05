<template>
  <location-rules-view
    :show="show"
    :rules="rules"
    :load="load"
    @toggleShow="show = !show"
    @send="send"
    @deleteRule="deleteOptions({optionsId: $event, type})"
  />
</template>

<script>
import LocationRulesView from '../game-rules/LocationRulesView';
import {createNamespacedHelpers} from 'vuex';
const { mapState, mapActions } = createNamespacedHelpers('tournamentOptions');

export default {
  name: 'TournamentRules',
  components: {LocationRulesView},
  data: () => ({
    show: false,
    type: 'rules',
  }),
  computed: mapState(['rules', 'load']),
  methods: {
    ...mapActions(['updateOrCreate', 'deleteOptions']),
    deleteRule(data) {
      console.log(data);
    },
    send({data, itemId}) {
      const formData = {
        type: this.type,
        ...data,
      };

      this.updateOrCreate({data: formData, optionsId: itemId});
    }
  },
};
</script>

<style scoped>

</style>
