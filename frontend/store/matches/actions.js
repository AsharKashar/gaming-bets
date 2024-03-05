import {STATE_STATUSES} from 'helpers/constants';
import get from 'lodash/get';

export default {
  async getMatches({commit}, {tournamentId, params = {}}) {
    commit('setStatus', STATE_STATUSES.READY);
    try {
      const res = await this.$bangerApi.get(`tournaments/${tournamentId}/matches`, {
        params: {
          per_page: 4,
          page: 1,
          ...params
        }
      });
      commit('setMatches', get(res, 'data.data', {}));
      commit('setStatus', STATE_STATUSES.PENDING);
    } catch (err) {
      console.log(err);
      commit('setStatus', STATE_STATUSES.ERROR);
    }
  },
  async getLeaderBoard({commit}, payload) {
    commit('setStatus', STATE_STATUSES.READY);

    try {
      const livedata = await this.$bangerApi.get(`/bracket-match/view-ladder/${payload}`);
      commit('getLeaderBoard', livedata.data);
      commit('setStatus', STATE_STATUSES.PENDING);
    } catch (err) {
      console.log(err);
      commit('setStatus', STATE_STATUSES.ERROR);
      return false;
    }
  },
  async uploadEvidence(ctx, {matchId, data}) {
    try {
      const formData = new FormData();

      Object.keys(data).forEach((key) => {
        if (key === 'files') {
          data.files.forEach(({file}) => {
            formData.append('files[]', file);
          });
          return;
        }
        formData.append(key, data[key]);
      });

      const res = await this.$bangerApi.post(`/matches/${matchId}/upload-evidence`, formData );
      return get(res, 'data.status') === 'success';
    } catch (e) {
      console.error(e);
      return false;
    }
  }
};
