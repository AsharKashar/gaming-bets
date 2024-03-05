const initialData = {
  data: []
};

export default {
  setprofileStatus(state, payload) {
    state.profileStatus = payload;
  },
  setjoinedTournaments(state, payload = initialData) {
    state.tournaments = payload;
  },
  setRanks(state, payload = initialData) {
    state.rank_data = payload;
  },
};
