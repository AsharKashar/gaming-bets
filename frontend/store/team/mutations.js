export default {
  setTeamsStatus(state, teamsStatus) {
    state.teamsStatus = teamsStatus;
  },
  setTeamTypes(state, payload) {
    state.teamTypes = payload;
  },
  setTeams(state, payload) {
    state.teams = payload;
  },
  setTeamDetails(state, payload) {
    state.teamDetails = payload;
  },
  setTeamFilters(state, payload) {
    state.filters = payload;
  },
  setActiveTeam(state, teamId) {
    state.activeTeam = state.teams.data.find(({team_id}) => team_id === teamId);
  },
  setTeamTypesStatus(state, payload) {
    state.teamTypesStatus = payload;
  }
};
