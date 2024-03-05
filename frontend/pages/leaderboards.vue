<template>
  <h1>{{ $t('Leaderboards page') }}</h1>
</template>

<script>
import { APP_URL } from 'configs/config';

export default {
  name: 'Leaderboards',
  created() {
    this.$router.push('/');
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Leaderboards',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  },
};
</script>

<style scoped>
</style>
