<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="tournament-item-tab tournament-item-tab--overview">
    <tournament-detail-wrap>
      <loader
        :loading="loading"
        center
        :overlay="false"
      >
        <div class="rules-wrapper">
          <v-expansion-panels>
            <v-expansion-panel
              v-for="rule in rules"
              :key="rule.id"
            >
              <v-expansion-panel-header disable-icon-rotate>
                {{ rule.rule }}
                <template v-slot:actions>
                  <v-icon
                    class="plus-icon"
                    color="error"
                    medium
                  >
                    mdi-plus
                  </v-icon>
                  <v-icon
                    class="minus-icon"
                    color="error"
                    medium
                  >
                    mdi-minus 
                  </v-icon>
                </template>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <ul>
                  <li>
                    {{ rule.rule }}
                  </li>
                </ul>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </div>
      </loader>
    </tournament-detail-wrap>
  </div>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
const { mapState } = createNamespacedHelpers('boxfight');
import TournamentDetailWrap from 'components/tournaments/detailWrap';
import { APP_URL } from 'configs/config';
import get from 'lodash/get';
import Loader from '@/components/Loader';
export default {
  name: 'TournamentsRules',
  middleware: ['hideHeader'],
  components:{ TournamentDetailWrap,Loader,},
  data(){
    return{
      rules:[
        {rule:'Testing...'},
        {rule:'Testing...'},
        {rule:'Testing...'},
        {rule:'Testing...'},
        {rule:'Testing...'},
      ],
      loading : false
    };
  },
  computed:{
    ...mapState(['currentBoxFight']),
    gameID(){
      return get(this.currentBoxFight , 'game.id' , null);
    },
  },
  async created(){  
    // this.loading = true;
    // const res = await  this.$bangerApi.post('box-match-rules/get-game-rule' , {game_id : this.gameID});
    // this.rules = res.data.Rules;
    // this.loading = false;
  },
  head () {
    const route = APP_URL + this.$route.path;
    return {
      title: 'Boxfight rules',
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
