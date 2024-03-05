export default {
  setTournaments(state, payload) {
    state.tournaments = payload.tournaments;
  },
  setCarouselTournaments(state, payload) {
    state.carouselTournaments = payload.tournaments;
  },
  setTournamentsStatus(state, status) {
    state.tournamentsStatus = status;
  },
  setTournamentFiltersStatus(state, status) {
    state.tournamentFiltersStatus = status;
  },
  setAvailableFilters(state, filters) {
    state.availableFilters = filters;
  },
  setCurrentTournaments(state, payload) {
    state.currentTournament = payload;
  },
  setCurrentTournamentTeam(state, payload) {
    state.currentTournamentTeam = payload;
  },
  setCurrentUserTeamsTournament(state, payload) {
    state.currentUserTeamsTournament = payload;
  },
  setCurrentTournamentRules(state, payload) {
    state.currentTournamentRules = payload;
  },
  getBrackets(state, payload) {
    state.brackets = payload;
  },
  setStatus(state, payload) {
    state.tournamentsStatus = payload;
  },
};
