<router>
 {
  name: 'tournamentOverview'
 }
</router>
<template>
  <div class="tournament-item-tab tournament-item-tab--overview">
    <tournaments-overview-info-list :tournament="currentTournament" />
    <tournament-detail-wrap>
      <template #default>
        <div
          class="heading"
          v-text="$t('ABOUT THIS TOURNAMENT')"
        />
        <div
          class="tournaments-overview__about-description"
          v-html="currentTournament.description"
        />
      </template>
      <template
        #sidebar
      >
        <links-list
          :links="currentTournament.tournament_links.join_links"
        />
      </template>
    </tournament-detail-wrap>
  </div>
</template>

<script>

import { createNamespacedHelpers } from 'vuex';
import TournamentsOverviewInfoList from 'components/tournaments/overview/InfoList';
import TournamentDetailWrap from 'components/tournaments/detailWrap';
import LinksList from 'components/list/LinksList';
import { APP_URL } from 'configs/config';
const { mapState } = createNamespacedHelpers('tournament');

export default {
  name: 'TournamentsOverview',
  components: {LinksList, TournamentDetailWrap, TournamentsOverviewInfoList},
  middleware: ['hideHeader'],
  computed: {
    ...mapState(['currentTournament']),
  },
  head () {
    const route = APP_URL + this.$route.path;
    return {
      title: 'Tournaments overview',
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
@import "~assets/styles/colors.scss";

.tournament-item-tab {
  padding-bottom: 120px;
}

.tournaments-overview__about {
  color: $text-primary-color;
  line-height: 1.1;
  display: flex;
  flex-wrap: wrap;
  &-col {
    width: 100%;
    &:first-child {
      max-width: calc(100% - 348px);
      padding-right: 96px;
      flex: 0 0 calc(100% - 348px);
    }
    &:last-child {
      max-width: 348px;
      flex: 0 0 348px;
    }
  }

  &-heading {
    font-size: 24px;
    margin-bottom: 8px;

    h2 {
      line-height: 1.3;
      text-transform: uppercase;
    }
  }
  &-description {
    font-size: 16px;
    line-height: 1.4;
    font-weight: 400;
    p {
      padding-bottom: 28px;
    }
  }
}
</style>
