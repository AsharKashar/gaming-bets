import { createNamespacedHelpers } from 'vuex';
const authModule = createNamespacedHelpers('auth');
const tournamentModule = createNamespacedHelpers('tournament');
const modalModule = createNamespacedHelpers('modal');
const boxfightModule = createNamespacedHelpers('boxfight');


import { JOINING_MATCH_STATES } from 'helpers/constants';
import get from 'lodash/get';
import { STATE_STATUSES } from 'helpers/constants';
export default {
  computed: {
    ...authModule.mapState(['isAuthenticated', 'user']),
    ...boxfightModule.mapState(['currentBoxFight','boxFightId']),
    currentMatch() {
      if (this.item) {
        return get(this, 'item', null);
      } else {
        return get(this, 'currentBoxFight', null);
      }
    },
    setItem(data) {
      this.item = data;
    },
    joinMatchState() {
      switch (this.currentMatch.remarks) {
        case JOINING_MATCH_STATES.NOT_LOGGED_IN:
          return {
            title: 'Login',
            disabled:false,
            action: id => this.joinTournament(id)
          };
        case JOINING_MATCH_STATES.CAN_JOIN:
          return {
            title: 'Join',
            disabled:false,
            action: id => this.joinTournament(id)
          };
        case JOINING_MATCH_STATES.JOINED:
          return {
            title: 'Joined',
            disabled:true,
            action: () => {}
          };
        case JOINING_MATCH_STATES.FULL:
          return {
            title: 'Full',
            disabled:true,
            action: id => {
              this.uploadMatchProof(id);
            }
          };
        case JOINING_MATCH_STATES.LIVE:
          return {
            title: 'End Match',
            disabled:false,
            action: id => this.endLiveMatch(id)
          };
        case JOINING_MATCH_STATES.RESULT_REQUIRED:
          return {
            title: 'Who Won??',
            disabled:false,
            action: (id, result) => this.updateMatchResult(id, result)
          };
        case JOINING_MATCH_STATES.RESULT_UPLOADED:
          return {
            title: 'Waiting for result',
            disabled:true,
            action: () => {}
          };
        case JOINING_MATCH_STATES.CONFLICT_RESULT_REQUIRED:
          return {
            title: 'Conflict Reupload result',
            disabled:false,
            action: id => this.uploadMatchProof(id)
          };
        case JOINING_MATCH_STATES.CONFLICT_RESULT_UPLOADED:
          return {
            title: 'Conflict Result Uploaded',
            disabled:true,
            action: () => {}
          };
        case JOINING_MATCH_STATES.CONFLICT_TIME_OVER:
          return {
            title: 'Time Over',
            disabled:true,
            action: () => {}
          };
        case JOINING_MATCH_STATES.WON:
          return {
            title: 'Watch Result',
            disabled:false,
            action: () => this.openResultModal('won')
          };
        case JOINING_MATCH_STATES.LOST:
          return {
            title: 'Watch Result',
            disabled:false,
            action: () => this.openResultModal('lost')
          };
        case JOINING_MATCH_STATES.NOT_AVAILABLE:
          return {
            title: 'Not Available',
            disabled:true,
            action: () => {}
          };
        // default for tournament
        default:
          return {
            title: 'Join',
            disabled:false,
            action: id => this.joinTournament(id)
          };
      }
    },
    isBoxFight() {
      return +this.$route.query.gameMode === this.boxFightId;
    }
  },
  methods: {
    ...modalModule.mapMutations(['setActiveModal']),
    ...tournamentModule.mapActions([
      'getCurrentTournament',
    ]),
    ...boxfightModule.mapMutations(['setBoxFightStatus']),
    ...boxfightModule.mapActions(['getCurrentBoxFight','getBoxFightTeams']),
    openTournament(tournamentId) {
      const { query } = this.$route;

      this.$router.push({
        path: `/tournaments/${tournamentId}`,
        query
      });
    },
    runPreTurnament(checkCoins, hasTeams) {
      if (checkCoins) {
        if (hasTeams) {
          this.setActiveModal({ type: 'SelectedTeam' });
          return;
        }
        this.setActiveModal({ type: 'CreateTeam' });
        return;
      }
      this.setActiveModal({ type: 'NotEnoughCoins' });
    },
    async joinTournament(id) {
      if (!this.isAuthenticated) {
        this.setActiveModal({
          type: 'LoginForm',
          options: {
            callback: this.runPreTurnament
          }
        });
        return;
      }

      if (this.isBoxFight) {
        this.getCurrentBoxFight({
          match_id: id,
          user_id: this.user.id
        });
        this.setActiveModal({
          type: 'JoinBoxFight'
        });
        this.getBoxFightTeams(id);
        return;
      }

      this.getCurrentTournament(id);

      //TODO::add params;
      this.runPreTurnament();
    },
    async endLiveMatch(id) {
      try {
        this.setBoxFightStatus(STATE_STATUSES.PENDING);
        await this.$bangerApi.get('box-matches/end-live-match/' + id);
        this.fetchCurrentMatch(id);
      } catch (err) {
        console.log(err);
      }
    },
    async updateMatchResult(id, result) {
      if (this.$route.name === 'tournaments-game-tournaments') {
        return this.openTournament(id);
      }

      try {
        this.setBoxFightStatus(STATE_STATUSES.PENDING);
        let payload = {
          user_id: this.user.id,
          result,
          game_id: this.currentBoxFight.game.id
        };

        await this.$bangerApi.post('box-matches/status-update/' + id, payload);
        this.fetchCurrentMatch(id);
      } catch (err) {
        console.log('Error in changing status ....>>>>', err);
      }
    },
    uploadMatchProof(id) {
      this.setActiveModal({
        type: 'UploadBoxFightProof'
      });
      if (this.item) {
        this.fetchCurrentMatch(id);
        this.getBoxFightTeams(id);
      }
    },
    fetchCurrentMatch(id) {
      this.getCurrentBoxFight({ match_id: id, user_id: this.user.id });
    },
    openResultModal(result) {
      let status = result === 'won';
      this.setActiveModal({
        type: 'BoxFightResult',
        options: {
          result: status,
          title: status
            ? 'Congratulations you won!'
            : 'Match Lost Better Luck, Next Time',
          XP: status ? 100 : null,
          coins: this.currentMatch.bid_amount
        }
      });
    }
  }
};
