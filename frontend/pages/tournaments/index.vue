<template>
  <div class="tournament-games">
    <div class="tournament-games__header">
      <div
        class="tournament-games__heading"
        v-text="$t('Choose Your Game')"
      />
      <user-info-heading />
    </div>

    <loader
      :loading="loading"
      :overlay="false"
      :center="true"
      height="90vh"
    >
      <cards-grid
        type="games-grid"
        :items="games"
      />
    </loader>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
const gameModule = createNamespacedHelpers('game');
const authentication = createNamespacedHelpers('auth');
import Loader from 'components/Loader.vue';
import CardsGrid from 'components/CardsGrid';
import UserInfoHeading from 'components/UserInfoHeading';
import { APP_URL } from 'configs/config';

export default {
  name: 'Tournaments',
  components: {
    UserInfoHeading,
    Loader,
    CardsGrid,
  },
  middleware: ['hideHeader'],
  data() {
    return {
      authModalType: 'login',
      showAuthModal: false,
    };
  },
  computed: {
    ...gameModule.mapState(['games', 'gamesStatus']),
    ...authentication.mapState(['user', 'isAuthenticated']),
    loading() {
      return this.gamesStatus === STATE_STATUSES.PENDING;
    },
  },
  created() {
    this.getGames();
  },
  methods: {
    ...gameModule.mapActions(['getGames']),
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Tournaments',
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
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .tournament-games {
    padding-bottom: 75px;
    max-width: 1110px;
    margin: 0 auto;

    &__header {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      padding: 35px 15px 96px;
    }
    &__heading {
      font-size: 32px;
      line-height: 1.15;
      font-weight: 800;
      color: $text-primary-color;
      padding-right: 15px;
    }
  }
</style>
