import api from '../../../services/api';

export default {
  namespaced: true,
  state: {},
  mutations: {},
  actions: {
    async setPlaces({commit}, {match_id, places}) {
      try {
        await api.post(`matches/${match_id}/set-places`, {
          places
        });
      } finally {
        commit('setLoadOptions', false);
      }
    }
  }
};
