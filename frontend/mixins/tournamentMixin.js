import { createNamespacedHelpers } from 'vuex';
import get from 'lodash/get';
import { TOURNAMENT_STATUS } from 'helpers/constants';

const tournamentModule = createNamespacedHelpers('tournament');
const modalModule = createNamespacedHelpers('modal');
const authModule = createNamespacedHelpers('auth');
const bombsModule = createNamespacedHelpers('bombs');
const boxfightModule = createNamespacedHelpers('boxfight');

import imgBomb from '~/static/images/bombs_pay.png';

export default {
  computed: {
    ...authModule.mapState(['isAuthenticated', 'user']),
    ...boxfightModule.mapState(['currentBoxFight' , 'boxFightId']),
    isBoxFight(){
      return this.boxFightId === +this.$route.query.gameMode;
    }
  },
  methods: {
    ...modalModule.mapMutations(['setActiveModal','setCommonData','clearModal']),
    ...tournamentModule.mapMutations(['setCurrentTournaments']),
    ...bombsModule.mapActions(['getBombPackages']),
    openJoinTournamentWizard(tournament) {
      this.getBombPackages();
      this.setCommonData({ tournament });
      if (this.isAuthenticated) {
        if (this.bombsEnoughForTournament(tournament)) {
          this.setActiveModal({type: 'TournamentTeamModal'});
        } else {
          this.setActiveModal({type: 'NotEnoughCoins'});
        }
      } else {
        this.setActiveModal({type: 'LoginForm'});
      }
    },
    bombsEnoughForTournament(tournament) {
      return this.user.all_bombs>=tournament.entry_fee;
    },
    openTournament(tournamentId) {
      const { query } = this.$route;
      // fetching the teams
      let path = `/tournaments/${tournamentId}`;
      if(this.isBoxFight) path = `/tournaments/boxfight/${tournamentId}`;
      this.$router.push(this.localeRoute({
        path,
        query
      }));
    },
    actionButtonText(tournament) {
      const status = get(tournament, 'status', {});
      const joined = get(tournament, 'user_joined', false);
      switch (status.type) {
        case TOURNAMENT_STATUS.UPCOMING:{
          return {
            text:'Upcoming',
            disabled:true,
          };
        }
        case TOURNAMENT_STATUS.REGISTRATION:{
          if (joined) {
            return {
              text:'JOINED',
              disabled:true
            };
          }
          return {
            text:`JOIN <img src="${imgBomb}"/> ${tournament.entry_fee}`,
            disabled:false,
            class: 'py-2'
          };
        }
        case TOURNAMENT_STATUS.FULL:{
          return {
            text:'FULL',
            disabled:true
          };
        }
        case TOURNAMENT_STATUS.LIVE:{
          return {
            text:'LIVE',
            disabled:true
          };
        }
        case TOURNAMENT_STATUS.ENDED:{
          return {
            text:'ENDED',
            disabled:true
          };
        }
        case TOURNAMENT_STATUS.FINISH_REGISTRATION:{
          return {
            text:'FINISH REGISTRATION',
            disabled:true
          };
        }
        case TOURNAMENT_STATUS.CANCELED:{
          return {
            text:'CANCELED',
            disabled:true
          };
        }
        default: return {};
      }
    },
  }
};
