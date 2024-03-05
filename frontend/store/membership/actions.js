import get from 'lodash/get';
import { STATE_STATUSES } from 'helpers/constants';

export default {
  async getMembershipPackages({commit}) {
    try {
      commit('setStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('packages/view');
      const membershipPackages = get(response, 'data.data', []);
      commit('setMembershipPackages', membershipPackages);
      commit('setStatus', STATE_STATUSES.READY);
    } catch (e) {
      console.log(e);
      commit('setStatus', STATE_STATUSES.ERROR);
    }
  },
  async addPaymentMethod({commit, state}, payload) {
    try {
      commit('setStatus', STATE_STATUSES.PENDING);
      const { data } = await this.$bangerApi.post(`card/add-payment-method/${payload.id}`, payload);

      const membershipResponse = await this.$bangerApi.post('membership/create-membership-subscription', {
        id:  payload.id,
        package_id: state.selectMemberShip,
        cardID: data.card_id
      });
      if (membershipResponse.data.status === 'true') {
        commit('setStatus', STATE_STATUSES.READY);
        commit('setIsSubscribed', true);
      } else {
        commit('setIsSubscribed', false);
        commit('setStatus', STATE_STATUSES.ERROR);
      }
    } catch (e) {
      console.log(e);
      commit('setResponseMsg', e.error);
      commit('setStatus', STATE_STATUSES.ERROR);
    }
  },
  async checkMemberShipActive({ commit }, payload) {
    commit('setStatus', STATE_STATUSES.PENDING);
    try {
      const response = await this.$bangerApi.get(`membership/check-if-exists/${payload}`);
      commit('activeMemberShipData', response.data);
      if (response.data.result === 'true') {
        commit('checkMemberShipActive', true);
      }
      else {
        commit('checkMemberShipActive', false);
      }
      commit('setStatus', STATE_STATUSES.READY);
    } catch (e) {
      console.log(e);
      commit('setStatus', STATE_STATUSES.ERROR);
    }
  },
  async cancelMemberShip({ commit }, payload) {
    try {
      commit('setStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.delete(`membership/cancel-subscription/${payload}`);
      commit('activeMemberShipData', {});
      if (response.data.success === 'true') {
        commit('setIsSubscribed', false);
      }
      else {
        commit('setIsSubscribed', true);
      }
      commit('setStatus', STATE_STATUSES.READY);
    } catch (e) {
      console.log(e);
      commit('setStatus', STATE_STATUSES.ERROR);
    }
  }
};



