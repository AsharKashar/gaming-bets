<template>
  <v-form
    ref="form"
    @submit.prevent="send"
  >
    <v-select
      v-if="create"
      v-model="activeType"
      name="type"
      label="Type"
      :items="type"
      item-text="name"
      return-object
      :rules="[(v) => !!Object.keys(v).length || 'Type is Required!']"
      :menu-props="{bottom: true, offsetY: true }"
    />

    <h2 v-else>
      {{ type | filterType }}
    </h2>

    <component
      :is="activeGroupType"
      :init-fields="initFields"
      @setOptions="fields = $event"
    />
    <div class="d-flex my-3">
      <v-btn
        v-if="!create"
        color="#E53935"
        dark
        class="mr-auto"
        :loading="load"
        @click="deleteOptions(optionsId)"
      >
        Delete
      </v-btn>

      <v-btn
        type="submit"
        :color="!create ? '#FBC02D' : '#43A047'"
        class="ml-auto"
        dark
        :loading="load"
      >
        {{ !create ? 'Update' : 'Create' }}
      </v-btn>
    </div>
  </v-form>
</template>

<script>
import Links from './options-group/Links';
import {createNamespacedHelpers} from 'vuex';
const { mapActions } = createNamespacedHelpers('globalOptions');

export default {
  name: 'OptionsForm',
  components: {Links},
  filters: {
    filterType(val) {
      if (!val) return '';
      val = val.replace('_', ' ');
      return val.toUpperCase();
    }
  },
  props: {
    activeGroup: {
      type: String,
      default: ''
    },
    initFields: {
      type: Array,
      default: () => ([]),
    },
    type: {
      type: [String, Array],
      default: () => ([]),
    },
    optionsId: {
      type: Number,
      default: undefined,
    },
  },
  data: () => ({
    activeType: {},
    load: false,
  }),
  computed: {
    activeGroupType() {
      return this.activeType.group ? this.activeType.group : this.activeGroup;
    },
    create() {
      return !this.optionsId;
    }
  },
  mounted() {
    this.fields = this.initFields;
  },
  methods: {
    ...mapActions(['updateOrCreate', 'deleteOptions']),
    async send() {
      if (!this.$refs.form.validate() || this.load) return;
      try {
        const data = {
          fields: this.fields,
          group: this.activeGroupType,
          type: typeof this.type === 'string' ? this.type : this.activeType.type,
        };
        await this.updateOrCreate({data, optionsId: this.optionsId});
        if (!this.optionsId) {
          this.$emit('updateForm');
        }
      } catch (e) {
        console.error(e);
      } finally {
        this.load = false;
      }
    },
  }
};
</script>

<style scoped>

</style>
