<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div>
    <h2>{{ $t('Profile Cash SubPage') }}</h2>
  </div>
</template>

<script>
import { APP_URL } from 'configs/config';

export default {
  name: 'ProfileCash',
  middleware: ['hideHeader'],
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Profile Cash',
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
