<template>
  <div>
    <div
      class="d-flex py-3"
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
    </div>
    <v-text-field
      v-model="rule.name"
      label="Title"
      :rules="[(v) => !!v || 'Title is Required!']"
      @change="setRule"
    />
    <v-divider />
    <textarea
      :id="id"
      v-model="rule.body"
    />
  </div>
</template>

<script>
export default {
  name: 'RuleItem',
  props: {
    initName: {
      type: String,
      default: '',
    },
    initBody: {
      type: String,
      default: '',
    },
  },
  data: () => ({
    rule: {
      name: '',
      body: '',
    },
    id: new Date().getTime(),
  }),
  created() {
    this.rule.name = this.initName;
    this.rule.body = this.initBody;
  },
  mounted() {
    // eslint-disable-next-line no-undef
    tinymce.init({
      selector: '#'+this.id,
      setup: (ed) => {
        ed.on('change', () => {
          this.rule.body = ed.getContent();
          this.setRule();
        });
      }
    });
  },
  beforeDestroy() {
    // eslint-disable-next-line no-undef
    tinymce.remove('#'+this.id);
  },
  methods: {
    setRule() {
      this.$emit('setRule', this.rule);
    }
  }
};
</script>

<style scoped>

</style>
