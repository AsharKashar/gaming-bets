<router>
  {
    name: 'tournamentMatches',
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="match-wrapper">
    <child-navigation
      :nav="childNav"
      child-prefix="/matches"
      nav-style="second-stile"
    />
    <nuxt-child />
  </div>
</template>

<script>
import { APP_URL } from 'configs/config';
import ChildNavigation from 'components/child-navigation';
export default {
  name: 'Matches',
  components: {ChildNavigation},
  middleware: [({route, redirect, app}) => {
    const { params, query } = route;
    if (!route.params.matchesType) {
      redirect(app.localeRoute({name: 'matchesChild', params: {...params, matchesType: 'live'}, query}));
    }
  }],
  data: () => ({
    childNav: [
      {
        title: 'Live Matches',
        name: 'matchesChild',
        params: {
          matchesType: 'live',
        }
      },
      {
        title: 'Upcoming',
        name: 'matchesChild',
        params: {
          matchesType: 'upcoming',
        }
      },
      {
        title: 'Past',
        name: 'matchesChild',
        params: {
          matchesType: 'past',
        }
      },
      {
        title: 'Pending Results',
        name: 'matchesChild',
        params: {
          matchesType: 'pending',
        }
      }
    ],
  }),
  computed: {
    tournamentId() {
      return this.$route.params.tournamentId;
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Matches',
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
