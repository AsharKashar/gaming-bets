<template>
  <div class="group-navigation-wrapper">
    <v-tabs
      background-color="#010432"
      slider-color="#BE1338"
      show-arrows
      next-icon="mdi-arrow-right-bold-box-outline"
      prev-icon="mdi-arrow-left-bold-box-outline"
      grow
    >
      <v-tab
        v-for="group in groups"
        :key="group.id"
        :disabled="disabled"
        @click="goLink(group.id)"
      >
        {{ group.name }}
      </v-tab>
    </v-tabs>
  </div>
</template>

<script>
export default {
  props: {
    groups: {
      type: Array,
      default: () => ([])
    },
    disabled: {
      type: Boolean,
      default:false,
    },
  },
  data() {
    return {};
  },
  methods: {
    goLink(id) {
      this.$emit('goLink', id);
    },
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.v-slide-group__content {
  border-bottom: 1px solid #a1afd326 !important;
}

.v-tab--active {
  color: #be1338 !important;
  font-weight: 900 !important;
}
.group-navigation-wrapper {
  border-style: inset;
  border-top: 0px solid $text-primary-color;
  border-left: 0px solid $text-primary-color;
  border-right: 0px solid $text-primary-color;
  border-bottom: 1px solid #a1afd342;
}
</style>
