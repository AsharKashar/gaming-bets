<template>
  <div class="location-rules">
    <div
      v-if="computedLang.length"
      class="my-2"
    >
      <v-btn
        color="#43A047"
        dark
        @click="$emit('toggleShow')"
      >
        Add locale Rule
      </v-btn>
      <v-expand-transition>
        <rules-form
          v-if="show"
          :is-create="true"
          :locales="computedLang"
          @send="$emit('send', {data: $event})"
        />
      </v-expand-transition>
    </div>

    <v-expansion-panels
      v-if="rules.length"
      accordion
      class="my-2"
    >
      <v-expansion-panel
        v-for="(item) in rules"
        :key="item.id"
      >
        <v-expansion-panel-header>
          <span><b>Locale:</b> {{ item.locale.name }}</span>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <rules-form
            :init-rules="item.data"
            @send="$emit('send', {data: $event, itemId: item.id})"
            @deleteRules="$emit('deleteRule', item.id)"
          />
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
    <loader :loading="load" />
  </div>
</template>

<script>
import RulesForm from './RulesForm';
import Loader from '../Loader';
import {createNamespacedHelpers} from 'vuex';

const { mapState } = createNamespacedHelpers('locales');

export default {
  name: 'LocationRulesView',
  components: {Loader, RulesForm},
  props: {
    rules: {
      type: Array,
      default: () => ([]),
    },
    show: {
      type: Boolean,
      default: false,
    },
    load: {
      type: Boolean,
      default: false,
    }
  },
  computed: {
    ...mapState(['locales']),
    computedLang() {
      const activeLocale = this.rules.map(({locale_id}) => locale_id);
      return this.locales.filter(({id}) => !activeLocale.includes(id));
    }
  },
};
</script>

<style scoped>
.location-rules {
  position: relative;
}
</style>
