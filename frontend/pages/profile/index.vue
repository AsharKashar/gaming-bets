<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="pt-0">
    <ProfilePicture />
    <ProfileDetail />
  </div>
</template>

<script>
import ProfilePicture from 'components/Profile/ProfilePicture';
import ProfileDetail from 'components/Profile/ProfileDetail';
import { APP_URL } from 'configs/config';
export default {
  name: 'GeneralInfo',
  components: {
    ProfileDetail,
    ProfilePicture,
  },
  middleware: ['hideHeader'],
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Profile',
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

<style scoped lang="scss">
@import "~/assets/styles/sizes";

@media only screen and (min-width: $tablet-large-width) {
  .container {
    max-width: 800px;
  }
}
</style>
