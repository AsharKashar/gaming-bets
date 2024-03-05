<template>
  <v-row>
    <v-col
      cols="12"
      class="d-flex"
    >
      <v-btn
        color="#43A047"
        dark
        class="ml-auto"
        @click="$emit('plus')"
      >
        +
      </v-btn>
      <v-btn
        color="#E53935"
        dark
        @click="$emit('minus')"
      >
        -
      </v-btn>
    </v-col>
    <v-col
      col="12"
      md="4"
    >
      <v-text-field
        v-model="field.title"
        label="Title"
        :rules="[(v) => !!v || 'Title is Required!']"
        @change="setField"
      />
    </v-col>
    <v-col
      col="12"
      md="4"
    >
      <v-text-field
        v-model="field.link"
        label="Link"
        :rules="[(v) => !!v || 'Link is Required!']"
        @change="setField"
      />
    </v-col>
    <v-col
      col="12"
      md="4"
    >
      <v-input
        :value="field.type"
        :rules="[(v)=>!!v || 'Field required']"
      >
        <div class="custom-select">
          <div class="custom-select__label">
            Type
          </div>
          <select
            v-model="field.type"
            class="form-control"
            required
            @change="setField"
          >
            <option
              v-for="({code, name}) in types"
              :key="code"
              :value="code"
            >
              {{ name }}
            </option>
          </select>
        </div>
      </v-input>
    </v-col>
  </v-row>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('globalOptions');

export default {
  name: 'LinkItem',
  props: {
    initField: {
      type: Object,
      default: () => ({}),
    },
  },
  data: () => ({
    field: {
      title: '',
      link: '',
      type: ''
    },
  }),
  computed: mapState({
    types: ({group}) => group.links
  }),
  mounted() {
    this.field = this.initField;
  },
  methods: {
    setField() {
      this.$emit('setOptions', this.field);
    }
  },
};
</script>
