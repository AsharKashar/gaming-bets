<template>
  <div>
    <v-btn
      color="#43A047"
      dark
      class="ml-auto"
      @click="plus"
    >
      Add links
    </v-btn>
    <link-item
      v-for="(field, i) in fields"
      :key="i"
      :init-field="field"
      @plus="plus"
      @minus="minus(i)"
      @setOptions="setField(i, $event)"
    />
  </div>
</template>
<script>
import LinkItem from './LinkItem';
export default {
  name: 'Links',
  components: {LinkItem},
  props: {
    initFields: {
      type: Array,
      default: () => ([]),
    }
  },
  data: () => ({
    fields: [],
  }),
  mounted() {
    this.fields = this.initFields;
    if (!this.fields.length) {
      this.plus();
    }
  },
  methods: {
    setField(i, field) {
      this.$set(this.fields, i, field);
      this.$emit('setOptions', this.fields);
    },
    plus() {
      this.fields.push({
        title: '',
        link: '',
        type: '',
      });
      this.$emit('setOptions', this.fields);
    },
    minus(i) {
      this.fields = this.fields.filter((el, idx) => idx !== i);
      this.$emit('setOptions', this.fields);
    }
  }
};
</script>
