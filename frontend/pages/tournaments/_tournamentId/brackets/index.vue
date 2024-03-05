<router>
  {
    name: 'tournamentBrackets',
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div
    v-if="Object.keys(brackets).length"
    class="brackets-wrapper"
  >
    <team-information />
  </div>
</template>
<script>
import TeamInformation from 'components/tournaments/brackets/teamInformation';
import { createNamespacedHelpers } from 'vuex';
import { APP_URL } from 'configs/config';
const { mapActions, mapState } = createNamespacedHelpers('tournament');

export default {
  name: 'Brackets',
  components: {
    TeamInformation
  },
  computed: mapState(['brackets']),
  watch: {
    brackets: {
      handler(val){
        console.log(val);
      },
      deep: true,
    }
  },
  mounted() {
    this.getBrackets();
    if (this.$route.path === `/tournaments/${this.$route.params.tournamentId}/brackets`) {
      this.$router.push(this.$route.path + '/group/1');
    } else {
      this.$router.push(this.$route.path);
    }
  },
  methods: mapActions(['getBrackets']),
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Brackets',
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
