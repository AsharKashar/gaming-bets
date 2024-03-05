export default {
  setGames(state, payload) {
    state.games = payload;
  },
  setGamesSearchList(state, payload) {
    state.gamesSearchList = payload;
  },
  setGamesStatus(state, payload) {
    state.gamesStatus = payload;
  },
  setCurrentGame(state, payload) {
    state.currentGame = payload;
  },
};
