<template>
  <v-img
    v-bind="$attrs"
    :lazy-src="lazySrc"
  />
</template>

<script>
export default {
  name: 'LazyImage',
  computed: {
    lazySrc() {
      return (
        this.$attrs.lazySrc ||
        this.$attrs['lazy-src'] ||
        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAQAAAA3fa6RAAAADklEQVR42mNkAANGCAUAACMAA2w/AMgAAAAASUVORK5CYII='
      );
    },
  },
};
</script>

<style lang="scss" scoped>
.v-image__image--cover {
  background-size: cover;
}
</style>