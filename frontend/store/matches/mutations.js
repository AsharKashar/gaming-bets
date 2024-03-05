export default {
  setStatus(state, payload) {
    state.matchStatus = payload;
  },
  setMatches(state, payload) {
    state.matches = payload;
  },
  getLeaderBoard(state, payload) {
    state.leaderBoard = payload;
  }
};
