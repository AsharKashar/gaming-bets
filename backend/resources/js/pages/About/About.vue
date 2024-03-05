<template>
  <banger-layout :class="[contentClass]">
    <b-container>
      <b-row />
    </b-container>
  </banger-layout>
</template>

<script>
import BangerLayout from 'Layouts/BangerLayout';

export default {
  name: 'Index',
  components: {
    BangerLayout,
  },
  data: () => ({
    contentClass: { grey: true, 'lighten-4': true, 'accent--text': true },
  }),
};
</script>

<style scoped>

</style>
