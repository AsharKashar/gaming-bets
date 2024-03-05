<template>
  <v-form
    ref="form"
    class="pa-3"
    @submit.prevent="send"
  >
    <slot
      name="formFields"
      :option="option"
      :set-fields="(fields) => setFields(fields)"
    />

    <div class="d-flex">
      <v-btn
        v-if="!isCreate"
        color="#E53935"
        dark
        class="mr-auto"
        :loading="load"
        @click="deleteOptions({optionsId:option.id, type })"
      >
        Delete
      </v-btn>

      <v-btn
        type="submit"
        :color="isCreate ? '#43A047' : '#FBC02D'"
        class="ml-auto"
        :loading="load"
        dark
      >
        {{ isCreate ? 'Create' : 'Update' }}
      </v-btn>
    </div>
  </v-form>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
const { mapActions, mapState } = createNamespacedHelpers('tournamentOptions');

export default {
  name: 'TournamentOptionsForm',
  props: {
    option: {
      type: Object,
      required: true,
    },
    type: {
      type: String,
      required: true,
    },
    itemKey: {
      type: String,
      default: undefined,
    }
  },
  data: () => ({
    fields: {},
    localeId: undefined,
  }),
  computed: {
    ...mapState(['load']),
    isCreate() {
      return !this.option.id;
    }
  },
  methods: {
    ...mapActions(['updateOrCreate', 'deleteOptions']),
    setFields(fields) {
      this.fields = fields;
    },
    send() {
      if (this.load || !Object.values(this.fields).length || !this.$refs.form.validate()) return;
      const data = {
        data: {},
        locale_id: this.option.locale_id,
        type: this.type,
      };
      if (this.itemKey) {
        data.data[this.itemKey] = this.fields;
      } else {
        data.data = this.fields;
      }
      this.updateOrCreate({data, optionsId: this.option.id});
    }
  },
};
</script>
