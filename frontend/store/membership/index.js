import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

const state = () => ({
  membershipPackages: [],
  membershipStatus: STATE_STATUSES.INIT,
  selectMemberShip: null,
  memberShipIsActive: false,
  isSubscribed: false,
  activeMemberShipData: [],
});

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters: {}
};
