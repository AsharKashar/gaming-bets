<template>
  <v-form
    ref="form"
    @submit.prevent="$refs.form.validate() ? $emit('send', { locale_id: localeId, data: rules }) : null"
  >
    <v-row>
      <v-col
        cols="12"
        md="6"
      >
        <v-input
          v-if="locales"
          :value="localeId"
          :rules="[(v)=>!!v || 'Locale is required']"
        >
          <div class="custom-select">
            <div class="custom-select__label">
              Locale
            </div>
            <select
              v-model="localeId"
              class="form-control"
              required
            >
              <option
                v-for="({id, name}) in locales"
                :key="id"
                :value="id"
              >
                {{ name }}
              </option>
            </select>
          </div>
        </v-input>
      </v-col>
      <v-col
        cols="12"
        md="6"
        class="text-right"
      >
        <v-btn
          color="#43A047"
          dark
          class="ml-auto"
          @click="plus"
        >
          Add rules
        </v-btn>
      </v-col>
    </v-row>

    <rule-item
      v-for="({name, body}, i) in rules"
      :key="i"
      :init-name="name"
      :init-body="body"
      @plus="plus"
      @minus="minus(i)"
      @setRule="setRule($event, i)"
    />

    <div class="d-flex py-2">
      <v-btn
        v-if="!isCreate"
        dark
        class="mr-auto"
        color="#E53935"
        @click="$emit('deleteRules')"
      >
        Delete
      </v-btn>

      <v-btn
        type="submit"
        :color="isCreate ? '#43A047' : '#FBC02D'"
        class="ml-auto"
        dark
      >
        {{ isCreate ? 'Create' : 'Update' }}
      </v-btn>
    </div>
  </v-form>
</template>

<script>
import RuleItem from './RuleItem';

export default {
  name: 'RulesForm',
  components: {RuleItem},
  props: {
    initRules: {
      type: Array,
      default: null,
    },
    locales: {
      type: [Array, Boolean],
      default: false,
    },
    isCreate: {
      type: Boolean,
      default: false,
    }
  },
  data: () => ({
    localeId: undefined,
    valid: false,
    rules: [],
  }),
  mounted() {
    if (!this.isCreate && this.initRules) {
      this.rules = this.initRules;
    } else {
      this.plus();
    }
  },
  methods: {
    setRule(rule, i) {
      this.$set(this.rules, i, rule);
    },
    plus() {
      this.rules.push({
        name: '',
        body: '',
      });
    },
    minus(i) {
      this.rules = this.rules.filter((el, idx) => idx !== i);
    },
  }
};
</script>
