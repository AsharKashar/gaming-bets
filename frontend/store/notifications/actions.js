import get from 'lodash/get';
import { STATE_STATUSES } from 'helpers/constants';

export default {
  async getUserNotifications({ commit }, params) {
    commit('setStatus', STATE_STATUSES.PENDING);
    try {
      const response = await this.$bangerApi.get('/notifications', { params });
      const notifications = get(response, 'data.data', {});
      if (!params) {
        commit('setNotifications', notifications );
      } else {
        commit('setNotificationsList', notifications );
      }
      commit('setStatus', STATE_STATUSES.READY);
    } catch (e) {
      commit('setStatus', STATE_STATUSES.ERROR);
    }
  },
  async markNotificationsAsRead({ dispatch }, params) {
    try {
      await this.$bangerApi.post('/notifications/read', {}, { params });
      dispatch('getUserNotifications');
    } catch (e) {
      console.error(e);
    }
  },
  async getFilters({ commit }) {
    try {
      commit('setStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('/notifications/filters');
      const filters = get(response, 'data.data', []);
      commit('setFilters', filters);
      commit('setStatus', STATE_STATUSES.READY);
      return filters;
    } catch (e) {
      commit('setStatus', STATE_STATUSES.ERROR);
      console.error(e);
    }
  }
};
