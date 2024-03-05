<template>
  <div
    v-if="loading"
    class="spinner"
  >
    <v-progress-circular
      :size="70"
      :width="7"
      color="blue-grey lighten-4"
      indeterminate
    />
  </div>
</template>

<script>
export default {
  name: 'Loader',
  props: {
    loading: {
      type: Boolean,
      default: false,
    }
  }
};
</script>

<style scoped>
.spinner {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: 3;
  background: #fff;
  opacity: .6;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
