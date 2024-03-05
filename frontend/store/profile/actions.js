import Vue from 'vue';
import get from 'lodash/get';
import { STATE_STATUSES } from 'helpers/constants';
export default {

  async uploadAvatar(ctx , data) {
    const formData = new FormData();

    Object.keys(data).map(key => {
      formData.append(key, data[key]);
    });

    try {
      await this.$bangerApi.post('profile/updateAvatar', formData);
      this.$router.push('/profile');
    } catch (e) {
      console.error(e);
    }
  },

  async saveWithDrawal({ commit }, payload) {
    commit('setprofileStatus', STATE_STATUSES.PENDING);
    try {
      await this.$bangerApi.post('profile/withdrawal', payload);
      commit('setprofileStatus', STATE_STATUSES.READY);
      Vue.notify({
        group: 'custom-notification',
        title: 'Success',
        text: 'Your withdrawal has been added.',
        type: 'success'
      });
      this.$router.push('/profile/withdrawal');
    } catch (e) {
      commit('setprofileStatus',  STATE_STATUSES.ERROR);
    }
  },

  async getTournaments({ commit }, params){
    try {
      const res = await this.$bangerApi.get('tournaments/joined',{params});
      commit('setjoinedTournaments', get(res, 'data.data', []));
    } catch (e) {
      commit('setjoinedTournaments');
      console.error(e);
    }
  },
  async getRanks({ commit },data){
    try {
      const res = await this.$bangerApi.post('profile/statistic',data);
      commit('setRanks', get(res, 'data.data', []));
    } catch (e) {
      commit('setRanks');
      console.error(e);
    }
  }
};
