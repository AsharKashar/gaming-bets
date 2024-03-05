import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

const initialData = {
  data: []
};

export default {
  namespaced: true,
  state: () => ({
    rank_data: { ...initialData },
    profile:{ ...initialData },
    tournaments :{ ...initialData },
    profileStatus:STATE_STATUSES.INIT,
  }),
  mutations,
  actions,
  getters: {}
};
