import actions from './actions';
import mutations from './mutators';
import { STATE_STATUSES } from 'helpers/constants';

const tournamentsObject = {
  data: []
};

const state = () => ({
  tournaments: { ...tournamentsObject },
  carouselTournaments: { ...tournamentsObject },
  currentTournament: {},
  currentUserTeamsTournament: {},
  currentTournamentTeam: {},
  currentTournamentRules: [],
  availableFilters: {},
  tournamentsStatus: STATE_STATUSES.INIT,
  tournamentFiltersStatus: STATE_STATUSES.INIT,
  brackets:{},
  // TODO :: it will be removed
  boxFightId: 4,
});

export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters: {}
};
