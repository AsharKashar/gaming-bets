<template>
  <div
    v-if="tournament && team"
    class="join-tournament"
  >
    <div class="join-tournament__inner">
      <div
        class="join-tournament__heading"
        v-text="$t('Match Summary')"
      />
      <div class="join-tournament__banner">
        <div class="join-tournament__banner-img">
          <v-img
            :src="tournament.image_url"
            :alt="tournament.name"
            height="100%"
          />
        </div>
        <div
          class="join-tournament__banner-title"
          v-text="tournament.name"
        />
      </div>
      <tournaments-overview-info-list :tournament="tournament">
        <template #after-block>
          <div class="tournaments-overview__info-col">
            <div class="tournaments-overview__info-col-inner">
              <div
                class="tournaments-overview__info-heading"
                v-text="$t('Team')"
              />
              <div class="tournaments-overview__info-description">
                <span v-text="team.name" />
              </div>
            </div>
          </div>
        </template>
      </tournaments-overview-info-list>
      <match-summary-action />
    </div>
  </div>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
import MatchSummaryAction from 'components/global-modal/match-summary/MatchSummaryAction';
import TournamentsOverviewInfoList from 'components/tournaments/overview/InfoList';

const { mapState } = createNamespacedHelpers('modal');

export default {
  name: 'MatchSummary',
  components: {TournamentsOverviewInfoList, MatchSummaryAction},
  computed: mapState({
    tournament: ({commonData}) => commonData.tournament,
    team: ({commonData}) => commonData.team,
  })
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";

.join-tournament {
  display: flex;
  align-items: center;
  justify-content: center;
  &__inner {
    max-width: 870px;
    padding: 20px 15px 35px;
    &::v-deep {
      .tournaments-overview {
        &__info-col {
          border-color: transparent;
        }
      }
    }
  }
  &__heading {
    font-weight: 900;
    font-size: 32px;
    margin-bottom: 20px;
    color: $text-secondary-color;
  }
  &__banner {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 18px;
    &-img {
      width: 100%;
      max-width: 159px;
      flex: 0 0 159px;
    }
    &-title {
      color: $text-hover-color;
      background: rgba(161, 175, 211, .32);
      width: 100%;
      max-width: calc(100% - 159px);
      flex: 0 0 calc(100% - 159px);
      padding: 30px 100px 30px 25px;
      font-weight: 800;
      font-size: 20px;
      line-height: 1.1;
      display: flex;
      align-items: center;
    }
  }
}
</style>
