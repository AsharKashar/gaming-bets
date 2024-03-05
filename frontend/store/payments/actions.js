import { STATE_STATUSES } from 'helpers/constants';
import get from 'lodash/get';

export default {
  async getSavedCards({ commit }) {
    try {
      commit('setStateItems', {
        paymentsDataStatus: STATE_STATUSES.PENDING,
        savedCards: []
      });
      const response = await this.$bangerApi.get('profile/payment/cards');
      commit('setStateItems', {
        paymentsDataStatus: STATE_STATUSES.READY,
        savedCards: get(response, 'data.data', [])
      });
    } catch (e) {
      console.error(e);
      commit('setStateItems', {
        paymentsDataStatus: STATE_STATUSES.READY
      });
    }
  }
};
