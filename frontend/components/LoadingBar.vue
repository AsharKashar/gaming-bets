<template>
  <loader
    :center="true"
    :loading="loading"
    opacity="0.9"
  />
</template>

<script>
import Loader from 'components/Loader';
export default {
  name: 'LoadingBar',
  components: {Loader},
  data: () => ({
    loading: false
  }),
  methods: {
    start() {
      this.loading = true;
    },
    finish() {
      this.loading = false;
    }
  }
};
</script>
