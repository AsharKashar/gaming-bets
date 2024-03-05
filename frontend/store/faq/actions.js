import { STATE_STATUSES } from 'helpers/constants';
import get from 'lodash/get';

export default {
  async getAllCategories({ commit }) {
    try {
      commit('setFaqStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('FAQ/get-catagories');
      commit('setAllCategories', get(response, 'data', []));
      commit('setFaqStatus', STATE_STATUSES.READY);
      return response.data;
    } catch (e) {
      commit('setFaqStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },
  async getCategoryDetails({ commit }, categoryId) {
    try {
      commit('setFaqStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('FAQ/get-catagory_faqs/' + categoryId);
      commit('setCategoryDetails', get(response, 'data', []));
      commit('setFaqStatus', STATE_STATUSES.READY);
      return response.data;
    } catch (e) {
      commit('setFaqStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },
  async searchFaqs({ commit }, text) {
    try {
      commit('setFaqStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('FAQ/search?search=' + text);
      commit('setFaqSearched', get(response, 'data', []));
      commit('setFaqStatus', STATE_STATUSES.READY);
      return response.data;
    } catch (e) {
      commit('setFaqStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },
  async getFaqs({ commit }) {
    try {
      commit('setFaqStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('FAQ/get-all-faqs');
      const faqs = get(response, 'data', []);
      commit('setFaqs', {
        faqs
      });
      commit('setFaqStatus', STATE_STATUSES.READY);
      return response.data;
    } catch (e) {
      commit('setFaqStatus', STATE_STATUSES.ERROR);
      console.log(e);
    }
  },

  async askQuestion({ commit }, params) {
    const formData = new FormData();
    Object.keys(params).map(key => {
      formData.append(key, params[key]);
    });
    try {
      commit('setFaqStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.post('FAQ/ask-question', formData);
      commit('setFaqStatus', STATE_STATUSES.READY);
      return response.data;
    } catch (err) {
      console.log(err);
      commit('setFaqStatus', STATE_STATUSES.ERROR);
      return err;
    }
  }
};
