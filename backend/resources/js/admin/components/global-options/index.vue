<template>
  <v-container class="my-3">
    <new-options />
    <options-list />
    <loader :loading="loadOptions" />
  </v-container>
</template>

<script>
import Loader from '../Loader';
import NewOptions from './NewOptions';
import OptionsList from './OptionsList';
import { createNamespacedHelpers } from 'vuex';
const { mapState, mapMutations } = createNamespacedHelpers('globalOptions');

export default {
  name: 'GlobalOptions',
  components: {OptionsList, NewOptions, Loader},
  props: {
    data: {
      type: Array,
      default: () => ([])
    },
  },
  computed: mapState(['loadOptions']),
  mounted() {
    this.setOptions(this.data);
  },
  methods: mapMutations(['setOptions']),
};
</script>
