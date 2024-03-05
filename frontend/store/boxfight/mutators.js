export default {
  setBoxFights(state, payload) {
    state.boxFights = payload;
  },
  setCurrentGameMode(state, payload) {
    state.currentGameMode = payload;
  },
  setCurrentBoxFight(state, payload) {
    state.currentBoxFight = payload;
  },
  setBoxFightStatus(state, payload) {
    state.boxFightStatus = payload;
  },
  setCurrentBoxFightTeams(state, payload) {
    state.currentBoxFightTeams = payload;
  },
  setBoxFightId(state, payload) {
    state.boxFightId = payload;
  },
  setBoxFightPagination(state, payload) {
    state.boxFightPagination = payload;
  }
};
  