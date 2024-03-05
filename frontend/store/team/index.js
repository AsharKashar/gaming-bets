import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

export default {
  namespaced: true,
  state: () => ({
    teams:{ data:[] },
    filters: {},
    teamTypes: [],
    teamTypesStatus: STATE_STATUSES.INIT,
    teamsStatus:STATE_STATUSES.INIT,
    activeTeam: {},
  }),
  actions,
  mutations,
  getters: {}
};
