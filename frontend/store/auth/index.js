import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

const state = () =>({
  user: null,
  isAuthenticated: false,
  checkStatus: STATE_STATUSES.INIT,
  callbackOAuthStatus: STATE_STATUSES.INIT,
});

export default {
  namespaced: true,
  state,
  actions,
  mutations,
};
