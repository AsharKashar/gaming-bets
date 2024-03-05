const initialState = {
  showHeader:true,
  showFooter:true,
  demoLayout:false,
  isProfile:false,
};

export default {
  namespaced: true,
  state: () => ({
    ...initialState
  }),
  mutations: {
    setLayoutProps(state, payload = initialState) {
      Object.keys(payload).map(key => {
        state[key] = payload[key];
      });
    }
  },
  actions: {}
};
