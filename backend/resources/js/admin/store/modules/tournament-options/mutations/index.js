export default {
  addLinks(state, payload) {
    state.links = [ ...state.links, payload ];
  },
  addRules(state, payload) {
    state.rules = [ ...state.rules, payload ];
  },
  setLinks(state, payload) {
    state.links = payload;
  },
  setRules(state, payload) {
    state.rules = payload;
  },
  setTournamentId(state, payload) {
    state.tournamentId = payload;
  },
  setLoad(state, payload) {
    state.load = payload;
  },
  setTypeLoad(state, payload) {
    state.typeLoad = payload;
  },
};
