<template>
  <div class="options-list">
    <options-form
      v-for="option in options"
      :key="option.id"
      :options-id="option.id"
      :type="option.type"
      :active-group="option.group"
      :init-fields="option.fields"
    />
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('globalOptions');

import OptionsForm from './OptionsForm';
export default {
  name: 'OptionsList',
  components: {OptionsForm},
  computed: mapState(['options']),
};
</script>
