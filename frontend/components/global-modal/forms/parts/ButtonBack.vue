<template>
  <button
    class="btn-back"
    v-text="$t('Back')"
  />
</template>

<script>
export default {
  name: 'ButtonBackFrom'
};
</script>

<style lang="scss" scoped>
@import '~/assets/styles/colors';

.btn-back {
  font-size: 20px;
  line-height: 1.2;
  color: $text-secondary-color;
}
</style>
