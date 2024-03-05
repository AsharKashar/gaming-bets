<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <loader :loading="true">
    <div class="join-container" />
  </loader>
</template>

<script>
import Loader from 'components/Loader.vue';
import { createNamespacedHelpers } from 'vuex';
import { APP_URL } from 'configs/config';
const { mapActions } = createNamespacedHelpers('team');

export default {
  name: 'TeamJoin',
  components:{
    Loader
  },
  middleware: ['hideHeader'],
  created () {
    const { team_token } = this.$route.query;
    if (team_token) {
      this.joinTeamByTeamToken(team_token);
      return;
    }

    this.$router.push('/');
  },
  methods:{
    ...mapActions(['joinTeamByTeamToken'])
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Team join',
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

<style scoped lang="scss">
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .join-container{
    background-color: $app-background;
  }

</style>
