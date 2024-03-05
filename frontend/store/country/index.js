import get from 'lodash/get';

export default {
  namespaced: true,
  state: () => ({
    loadCountry: false,
    countries: [],
  }),
  mutations: {
    setLoadCountry(state, payload) {
      state.loadCountry = payload;
    },
    setCountries(state, payload) {
      state.countries = payload;
    }
  },
  actions: {
    async getCountries({commit}) {
      commit('setLoadCountry', true);
      try {
        const res = await this.$bangerApi.get('/countries');
        commit('setCountries', get(res, 'data.data', []));
      } finally {
        commit('setLoadCountry', false);
      }
    }
  }
};
