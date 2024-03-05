import api from '../../../../services/api';

export default {
  async updateOrCreate({commit, dispatch, state}, {optionsId, data}) {
    commit('setLoad', true);
    const formData = {
      ...data,
      tournament_id: state.tournamentId
    };
    try {
      if (!optionsId) {
        await api.post('tournament/options', formData);
      } else {
        await api.put(`tournament/options/${optionsId}`, formData);
      }

      dispatch('getTournamentOptionsByType', data.type);
    } finally {
      commit('setLoad', false);
    }
  },
  async deleteOptions({commit, dispatch}, {optionsId, type}) {
    commit('setLoad', true);
    try {
      await api.delete(`tournament/options/${optionsId}`);
      dispatch('getTournamentOptionsByType', type);
    } finally {
      commit('setLoad', false);
    }
  },

  async getTournamentOptionsByType({commit}, type) {
    commit('setTypeLoad', true);
    try {
      const { data } = await api.post('tournament/options/type', {type});
      const method = 'set' + type.charAt(0).toUpperCase() + type.slice(1);
      commit(method, data.data);
    } finally {
      commit('setTypeLoad', false);
    }
  }
};
