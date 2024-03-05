<template>
  <div class="page-wrap">
    <button-back />
    <div class="tournament__header">
      <user-info-heading class="ml-auto" />
    </div>
    <div
      class="tournament-content"
    >
      <tournaments-banner
        :img-src="currentTournament.image_url"
        :title="currentTournament.name"
        :current-tournament="currentTournament"
      />
      <tournaments-detail :details="tournamentDetails" />
      <child-navigation
        :prop-carousel="{ responsive: null }"
      />
      <nuxt-child />
    </div>
  </div>
</template>

<script>

import TournamentsDetail from 'components/tournaments/Detail';
import ChildNavigation from 'components/child-navigation';
import { createNamespacedHelpers } from 'vuex';
import UserInfoHeading from 'components/UserInfoHeading';
import ButtonBack from 'components/ButtonBack';
import { APP_URL } from 'configs/config';
import TournamentsBanner from 'components/tournaments/Banner';
const tournamentModule = createNamespacedHelpers('tournament');

export default {
  name: 'Tournament',
  components: {
    TournamentsBanner,
    ButtonBack,
    UserInfoHeading,
    ChildNavigation,
    TournamentsDetail,
  },
  middleware: ['hideHeader', ({route, redirect, app}) => {
    const { matched, query, params } = route;
    if (matched.length === 1) {
      redirect(app.localeRoute({name: 'tournamentOverview', query, params}));
    }
  }],
  async asyncData({route, store}) {
    await store.dispatch('tournament/getCurrentTournament', route.params.tournamentId);
  },
  computed: {
    ...tournamentModule.mapState(['currentTournament',]),
    tournamentDetails() {
      return [
        {
          title: 'Prize pool',
          description: '$1,000'
        },
        {
          title: 'Entry Fee',
          description: this.currentTournament.entry_fee
        },
        {
          title: 'Country',
          description: 'Online, All Countries'
        },
        {
          title: 'Host',
          description: this.currentTournament.hosted_by
        }
      ];
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Tournament',
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
