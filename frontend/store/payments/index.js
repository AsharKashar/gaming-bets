import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

export default {
  namespaced: true,
  state: () => ({
    savedCards:[],
    paymentsDataStatus: STATE_STATUSES.INIT
  }),
  actions,
  mutations,
};
