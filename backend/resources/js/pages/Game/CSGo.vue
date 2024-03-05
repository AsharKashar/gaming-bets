<template>
  <banger-layout :class="[contentClass]">
    <b-container>
      <b-row>
        CS:GO page
      </b-row>
    </b-container>
  </banger-layout>
</template>

<script>
import BangerLayout from 'Layouts/BangerLayout';

export default {
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
