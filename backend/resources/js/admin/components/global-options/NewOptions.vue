<template>
  <div
    v-if="filterType.length"
    :key="key"
    class="new-options"
  >
    <div class="d-flex">
      <v-btn
        :color="show ? '#E53935': '#43A047'"
        dark
        class="ml-auto"
        @click="show = !show"
      >
        {{ show ? 'Close' : 'New Options' }}
      </v-btn>
    </div>
    <v-slide-y-transition>
      <options-form
        v-show="show"
        :type="filterType"
        @updateForm="updateForm"
      />
    </v-slide-y-transition>
  </div>
</template>

<script>
import OptionsForm from './OptionsForm';
import { createNamespacedHelpers } from 'vuex';
const { mapGetters } = createNamespacedHelpers('globalOptions');

export default {
  name: 'NewOptions',
  components: {OptionsForm},
  data: () => ({
    show: false,
    key: 1,
  }),
  computed: {
    ...mapGetters(['filterType']),
  },
  methods: {
    updateForm() {
      this.show = false;
      this.key+=1;
    }
  }
};
</script>
