<router>
  {
  name: 'tournamentRules',
  meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="tournament-item-tab tournament-item-tab--overview">
    <tournament-detail-wrap>
      <template #default>
        <div
          class="heading"
          v-text="$t('Rules')"
        />
        <rules-list />
      </template>
      <template #sidebar>
        <links-list
          title="Support"
          :links="currentTournament.tournament_links.support_links"
        />
        <links-list
          title="Streams:"
          :links="currentTournament.tournament_links.stream_links"
        />
      </template>
    </tournament-detail-wrap>
  </div>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
const { mapState } = createNamespacedHelpers('tournament');
import TournamentDetailWrap from 'components/tournaments/detailWrap';
import RulesList from 'components/tournaments/rules/RulesList';
import LinksList from 'components/list/LinksList';
import { APP_URL } from 'configs/config';
export default {
  name: 'TournamentsRules',
  middleware: ['hideHeader'],
  components:{ TournamentDetailWrap,RulesList,LinksList},
  data(){
    return{
      rules:[],
      loading : false
    };
  },
  computed:{
    ...mapState(['currentTournament']),
  },
  head () {
    const route = APP_URL + this.$route.path;
    return {
      title: 'Tournaments rules',
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
  @import "~/assets/styles/sizes.scss";
  @import "~/assets/styles/colors.scss";


  .rules-wrapper {
    &::v-deep{


      .plus-icon{
        display: block;
      }
      .minus-icon{
        display: none;
      }
      .v-expansion-panel-header--active{
        .plus-icon{
          display: none;
        }
        .minus-icon{
          display: block;
        }
      }
      .v-expansion-panel{
        border-radius: 2px !important;
          margin: 2px 0 !important;
          background: $secondary-background;
        }
    }
  }

 @media all and (min-width: $tablet-small-width) {
   .rules-wrapper{
  max-width: 70%;
}
 }
</style>
