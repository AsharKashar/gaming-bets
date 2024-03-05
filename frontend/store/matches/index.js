import actions from './actions';
import mutations from './mutations';
import {STATE_STATUSES} from 'helpers/constants';

export default {
  namespaced: true,
  state: {
    matchStatus: STATE_STATUSES.INIT,
    matches: {
      items: [],
      pagination: {},
    },
    leaderBoard:[]
  },
  actions,
  mutations,
  getters: {}
};
