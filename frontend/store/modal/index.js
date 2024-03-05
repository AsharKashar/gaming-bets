export default {
  namespaced: true,
  state: () => ({
    activeModal: null,
    modalOptions: {},
    commonData: {}
  }),
  mutations: {
    setActiveModal(state, { type = '', options = {} }) {
      state.activeModal = type;
      state.modalOptions = options;
      if(!type) {
        state.commonData = {};
        state.modalOptions = options;
      }
    },
    setCommonData(state, data) {
      state.commonData = {
        ...state.commonData,
        ...data
      };
    },
    clearModal(state) {
      state.activeModal = null;
      state.modalOptions = {};
      state.commonData = {};
    }
  }
};
