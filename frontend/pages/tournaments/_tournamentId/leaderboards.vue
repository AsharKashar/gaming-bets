<router>
  {
    name: 'tournamentLeaderboards',
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="leader-board">
    <Loader :loading="loader" />
    <cards :leader-board="leaderBoard" />
    <inline-cards :leader-board="leaderBoard" />
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const matchesModule = createNamespacedHelpers('matches');
import Loader from 'components/Loader';
import Cards from 'components/tournaments/leaderboards/cards';
import InlineCards from 'components/tournaments/leaderboards/inlineCards';
import { APP_URL } from 'configs/config';
export default {
  name: 'Leaderboards',
  components: {
    InlineCards,
    Cards,
    Loader,
  },
  computed: {
    ...matchesModule.mapState(['leaderBoard', 'matchStatus']),
    loader() {
      return this.matchStatus !== 'pending';
    },
  },
  created() {
    this.getLeaderBoard(this.$route.params.tournamentId);
  },
  methods: {
    ...matchesModule.mapActions(['getLeaderBoard']),
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
  }
};
</script>

<style lang="scss" scoped>
</style>
