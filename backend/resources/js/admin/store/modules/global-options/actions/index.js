import api from '../../../../services/api';

export default {
  async getOptions({commit}) {
    commit('setLoadOptions', true);
    try {
      const { data } = await api.get('global-options/all');
      if (data && data.data) {
        commit('setOptions', data.data);
      }
    } finally {
      commit('setLoadOptions', false);
    }
  },
  async updateOrCreate({commit, dispatch}, {optionsId, data}) {
    commit('setLoadOptions', true);
    try {
      if (!optionsId) {
        await api.post('global-options', data);
      } else {
        await api.put(`global-options/${optionsId}`, data);
      }
      dispatch('getOptions');
    } finally {
      commit('setLoadOptions', false);
    }
  },
  async deleteOptions({commit, dispatch}, optionsId) {
    commit('setLoadOptions', true);
    try {
      await api.delete(`global-options/${optionsId}`);
      dispatch('getOptions');
    } finally {
      commit('setLoadOptions', false);
    }
  },
};
