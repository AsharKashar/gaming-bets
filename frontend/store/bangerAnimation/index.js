import mutations from './mutations';

export default {
  namespaced: true,
  state:() => ({
    showBanger: false
  }),
  mutations,
};
