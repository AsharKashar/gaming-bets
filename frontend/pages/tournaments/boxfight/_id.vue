<template>
  <div
    ref="pageContainer"
    class="page-wrap"
  >
    <loader
      :loading="loading"
      :overlay="true"
    >
      <button-back :to="`/tournaments/games/${gameID}`" />
      <div class="tournament__header">
        <user-info-heading class="ml-auto" />
      </div>
      <div
        v-if="currentBoxFight"
        class="tournament-content"
      >
        <boxfight-banner 
          :img-src="currentMatchDetails.image"
          :title="currentMatchDetails.title"
          :current-tournament="currentBoxFight"
        />
        <boxfight-detail :details="tournamentDetails" />
        <boxfight-child-navigation />
        <nuxt-child />
      </div>
    </loader>
  </div>
</template>

<script>

import { createNamespacedHelpers } from 'vuex';
import UserInfoHeading from 'components/UserInfoHeading';
import ButtonBack from 'components/ButtonBack';
import { APP_URL } from 'configs/config';
const boxfightModule = createNamespacedHelpers('boxfight');
const authModule = createNamespacedHelpers('auth');
import Loader from 'components/Loader';
import { STATE_STATUSES } from 'helpers/constants';
import get from 'lodash/get';
import BoxfightBanner from 'components/boxfight/BoxfightBanner';
import BoxfightDetail from 'components/boxfight/BoxfightDetail';
import BoxfightChildNavigation from 'components/boxfight/BoxfightChildNavigation';

export default {
  name: 'Tournament',
  components: {
    ButtonBack,
    UserInfoHeading,
    Loader,
    BoxfightBanner,
    BoxfightDetail,
    BoxfightChildNavigation
  },
  middleware: ['hideHeader', ({route, redirect}) => {
    if (route.matched.length === 1) {
      redirect({path: route.path + '/overview', query: route.query});
    }
  }],
  computed: {
    ...authModule.mapState(['user', 'isAuthenticated']),
    ...boxfightModule.mapState([
      'boxFightStatus',
      'currentBoxFight',
      'boxFightId']),
    loading() {
      return this.boxFightStatus === STATE_STATUSES.PENDING;

    },
    currentMatchDetails() {
      return  {
        title: this.currentBoxFight.boxmatch_name,
        image: this.currentBoxFight.game.image_public_url
      };

    },
    tournamentDetails() {
      return [
        {
          title: 'Match Type',
          description: this.currentBoxFight.game_type_boxmatch.description
        },
        {
          title: 'Wager Amount',
          description: this.currentBoxFight.bid_amount + ' ' + 'BOMBS'
        },
        {
          title: 'Country',
          description: 'Online, All Countries'
        },
        {
          title: 'Host',
          description: this.currentBoxFight.user.name
        }
      ];
    },
    gameID(){
      return  get(this , 'currentBoxFight.game_id' , 1);
    }
  },
  created() {
    const tournament_id = this.$route.params.id;
    let user_id = this.isAuthenticated ? this.user.id : 0;
    this.getCurrentBoxFight({
      match_id: tournament_id,
      user_id
    });
    this.getBoxFightTeams(tournament_id);
  },
  mounted(){
    try {
      document.getElementById('wrap-scroll-bar').scrollTo(0, this.$refs.pageContainer.offsetTop - 200);
    } catch (e) {
      console.error(e);
    }
  },
  methods:{
    ...boxfightModule.mapActions([
      'getCurrentBoxFight',
      'getBoxFightTeams'
    ]),
    ...boxfightModule.mapMutations(['setBoxFightModal'])
  },
  head () {
    const route = APP_URL + this.$route.path;
    return {
      title: 'Boxfight',
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

<style lang="scss" scoped>
.tournament {
  &__header {
    display: flex;
    margin: 35px 0 51px;
  }
}
</style>
