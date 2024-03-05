import get from 'lodash/get';
import Vue from 'vue';
import { STATE_STATUSES } from 'helpers/constants';

export default {
  async getBombPackages({commit}) {
    try {
      commit('setStatus', { status: STATE_STATUSES.PENDING });
      const response = await this.$bangerApi.get('bomb-package/get-packages');
      const bombPackages = get(response, 'data.data', []);

      commit('setBombPackages', {
        bombPackages
      });
      commit('setStatus', { status: STATE_STATUSES.READY });
    } catch (e) {
      console.error(e);
      commit('setStatus', { status: STATE_STATUSES.PENDING });
    }
  },
  async getPreUserCoins({ commit }, payload) {
    try {
      commit('setStatus', { status: STATE_STATUSES.PENDING });
      const { data } = await this.$bangerApi.get(`payment/get-user-bombs/${payload}`);
      commit('setPreUserCoins', data.bombs);
      commit('setStatus', { status: STATE_STATUSES.READY });
    } catch (e) {
      console.log(e);
      commit('setStatus', { status: STATE_STATUSES.PENDING });
    }
  },
  async buyBombPackage({ commit }, payload) {
    try {

      commit('setHaveBuy', false);
      commit('setStatus', { status: STATE_STATUSES.PENDING });
      const data = await this.$bangerApi.post('payment/bomb-purchase-token', payload, { customErrorHandling: true });
      const user = get(data, 'data.data', false);

      if (user) {
        this.commit('auth/setMe', {user});
        this.commit('auth/setAuthenticated',true);
      }
      commit('setHaveBuy', true);
      commit('setTotalUserCoins', payload);
      commit('setStatus', { status: STATE_STATUSES.READY });
      return user;
    } catch (e) {
      const message = get(e, 'response.data.message', 'Payment Error');
      commit('setStatus', { status: STATE_STATUSES.error });
      Vue.notify({
        group: 'custom-notification',
        title: 'Payment error',
        text: message,
        type: 'error'
      });
      return false;
    }
  },
  setHaveBuy({ commit }, payoad) {
    commit('setHaveBuy', payoad);
  }
};
