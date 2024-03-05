import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

const state = () => ({
  games:[],
  currentGame: {},
  gamesSearchList:[],
  gamesStatus: STATE_STATUSES.INIT
});

export default {
  namespaced: true,
  state,
  actions,
  mutations,
};
