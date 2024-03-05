<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div>
    {{ $t('Profile Settings Page') }}
  </div>
</template>

<script>
import { APP_URL } from 'configs/config';

export default {
  name: 'Settings',
  middleware: ['hideHeader'],
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Profile Settings',
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
