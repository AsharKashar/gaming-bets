<template>
  <div class="tournament-wrapper">
    <div class="tournament-header">
      <h1 class="heading">
        My matches
      </h1>
      <user-info-heading />
    </div>
    <child-navigation
      nav-prefix="/my-tournament"
      :nav="nav"
    />
    <client-only>
      <carousel
        class="tournaments-tabs"
        rewind
        :dots="false"
        :nav="false"
        auto-width
      >
        <tournament-tab-button
          v-for="game in games"
          :key="game.id"
          :item="game"
          :v-value="game.id"
          :value="+filtersParams.gameId"
          :on-click="() => setFilterKey(game.id, 'gameId', true)"
        />
      </carousel>
    </client-only>
    <nuxt-child />
  </div>
</template>

<script>
import UserInfoHeading from 'components/UserInfoHeading';
import ChildNavigation from 'components/child-navigation';
import { APP_URL } from 'configs/config';
import {createNamespacedHelpers} from 'vuex';
import TournamentTabButton from 'components/BrowseTournaments/TournamentTabButton';
import mixinFilterRout from '@/mixins/mixinFilterRout';
import {get} from 'lodash';
const gameModule = createNamespacedHelpers('game');
const carousel = () => process.browser ? import ('vue-owl-carousel') : null;

export default {
  name: 'MyTournament',
  components: {TournamentTabButton, carousel, ChildNavigation, UserInfoHeading},
  middleware: ['hideHeader', 'authenticatedCheck'],
  mixins: [mixinFilterRout],
  async asyncData({ store, route }) {
    await store.dispatch('game/getGames');

    const gameId = get(store, 'state.game.games[0].id');

    return ({
      initFilter: {
        gameId,
        ...route.query
      }
    });
  },
  data: () => ({
    nav: [
      {
        title: 'Tournaments',
        name: 'ch_myTournaments',
      },
      {
        title: 'Challenges',
        name: 'ch_myChallenges',
      },
      {
        title: 'History',
        name: 'ch_myHistory',
      },
    ]
  }),
  computed: {
    ...gameModule.mapState(['games']),
  },
  methods: {
    callbackFilter(filter) {
      console.log(filter);
    }
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'My tournament',
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
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";
.tournament-wrapper {
  max-width: 1110px;
  margin: 0 auto;
  padding: 1em 2em;
  .tournament-header {
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 3em 0;

    .heading {
      font-weight: 800;
      font-size: 56px;
      line-height: 94%;
      color: $text-primary-color;
    }
  }
}

</style>
