export default {
  namespaced: true,
  state: {
    locales: [],
  },
  mutations: {
    setLocales(state, payload) {
      state.locales = payload;
    },
  }
};
