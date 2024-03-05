import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

const state = () => ({
  bombPackages: [],
  status: STATE_STATUSES.INIT,
  haveBuy:false,
  preCoins:0,
  totalCoins:0
});

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters: {}
};
