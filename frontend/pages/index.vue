<template>
  <div>
    <div v-if="!comingSoon">
      <home-page-carousel />
      <features-games />
      <browse-tournaments />
      <challenge />
      <bomb-coins-membership />
      <top-of-the-month />
      <home-icons-block />
      <blogs />
    </div>
    <coming-soon-block v-if="comingSoon" />
  </div>
</template>

<script>
import HomePageCarousel from 'components/HomePage/MainCarousel.vue';
import FeaturesGames from 'components/HomePage/FeaturesGames';
import ComingSoonBlock from 'components/ComingSoonBlock';
import Blogs from 'components/Blogs';
import BrowseTournaments from 'components/BrowseTournaments';
import BombCoinsMembership from 'components/BombCoinsMembership';
import TopOfTheMonth from 'components/TopOfTheMonth';
import HomeIconsBlock from 'components/HomeIconsBlock';
import Challenge from 'components/challenge/index';
import { VUE_MODE, APP_URL } from 'configs/config';
const isProd = VUE_MODE === 'production';

export default {
  name: 'Home',
  components: {
    HomePageCarousel,
    FeaturesGames,
    ComingSoonBlock,
    Blogs,
    BrowseTournaments,
    BombCoinsMembership,
    TopOfTheMonth,
    HomeIconsBlock,
    Challenge
  },
  async asyncData({ store }) {
    store.commit('layout/setLayoutProps', {
      showHeader: !isProd,
      demoLayout: isProd,
    });
    await store.dispatch('game/getGames');
  },
  data: () => ({
    comingSoon: isProd,
  }),
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Home',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ],
      meta: [
        { hid: 'robots', name: 'robots', content: 'all' },
      ]
    };
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes.scss";
@media all and (max-width: $tablet-small-width) {
  ::v-deep {
    .pagination-container {
      padding: 0 15px;
    }
    .filters-list-wrapper {
      .burger {
        padding-right: 15px;
      }
    }
    .tournaments-grid {
      padding: 0 12px;
    }
  }
}

</style>
