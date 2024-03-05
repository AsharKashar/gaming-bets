<template>
  <h1>{{ $t('Contact Page') }}</h1>
</template>

<script>
import { APP_URL } from 'configs/config';

export default {
  name: 'Contact',
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Contact',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>

<style scoped>

</style>
