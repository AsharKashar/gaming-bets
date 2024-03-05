export default {
  setStateItems(state, payload) {
    Object.keys(payload).map(key => {
      state[key] = payload[key];
    });
  }
};
