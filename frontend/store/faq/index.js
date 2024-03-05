import actions from './actions';
import mutations from './mutations';
import { STATE_STATUSES } from 'helpers/constants';

const state = () => ({
  faqs: [],
  categoryDetails: {},
  allCategories: [],
  faqSearched: [],
  faqStatus: STATE_STATUSES.INIT
});

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters: {}
};
