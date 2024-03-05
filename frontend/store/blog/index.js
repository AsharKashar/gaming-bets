import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

const postsObject = {
  data:[]
};

const state = () => ({
  categories:[],
  categoryItem: {},
  postItem: {},
  latestPosts:{ ...postsObject },
  categoryPosts: { ...postsObject },
  status: STATE_STATUSES.INIT,
  postsStatus: STATE_STATUSES.INIT,
});

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters: {}
};
