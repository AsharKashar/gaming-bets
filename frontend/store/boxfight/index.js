import actions from './actions';
import mutations from './mutators';
import { STATE_STATUSES } from 'helpers/constants';


const state = () => ({
  boxFights: [],
  currentBoxFight: null,
  currentBoxFightTeams: null,
  boxFightStatus: STATE_STATUSES.INIT,
  boxFightPagination : null,
  boxFightId: 4,
});

export default {
  namespaced: true,
  state,
  actions,
  mutations
};
