export default {
  setBombPackages(state, payload) {
    state.bombPackages = payload.bombPackages;
  },
  setStatus(state, payload) {
    state.status = payload.status;
  },
  setHaveBuy(state, payload) {
    state.haveBuy = payload;
  },
  setPreUserCoins(state, payload) {
    state.preCoins = payload;
    state.totalCoins = payload;
  },
  setTotalUserCoins(state, payload) {
    let totalNewCoins = parseInt(state.totalCoins) + parseInt(payload.newCoins);
    state.totalCoins = totalNewCoins.toString()+'.00';
  }
};
