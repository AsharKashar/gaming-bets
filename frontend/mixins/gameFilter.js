import isEqual from 'lodash/isEqual';
import { createNamespacedHelpers } from 'vuex';
import { STATE_STATUSES } from 'helpers/constants';
const teamModule = createNamespacedHelpers('team');
const gameModule = createNamespacedHelpers('game');

export default {
  computed:{
    ...teamModule.mapState(['teams', 'teamTypes', 'teamTypesStatus', 'teamsStatus']),
    ...gameModule.mapState(['games', 'gamesStatus']),
    teamsAreLoading(){
      return this.teamsStatus === STATE_STATUSES.PENDING || this.teamsStatus === STATE_STATUSES.INIT;
    },
    currentGame(){
      return this.games.find(game => game.id === +this.$route.query.gameId) || {};
    },
    currentSize() {
      return this.teamTypes.findIndex(({id}) => id === +this.$route.query.teamSizeId);
    },
    loadFilter() {
      return this.gamesStatus === STATE_STATUSES.PENDING || this.teamTypesStatus === STATE_STATUSES.PENDING;
    },
  },
  mounted () {
    this.initFilter();
  },
  methods: {
    ...teamModule.mapMutations(['seatActiveTeam', 'setTeamFilters', 'setTeams']),
    ...teamModule.mapActions(['getFilteredTeams', 'getTeams', 'getTeamTypes']),
    ...gameModule.mapActions(['getGames']),
    updateFilters(filters) {
      const { gameId, teamSizeId, page } = this.$route.query;
      const queryFilter = {
        gameId: +gameId,
        teamSizeId: +teamSizeId,
        page: +page,
      };
      const newFilter = {
        ...queryFilter,
        ...filters
      };
      if (!isEqual(queryFilter, newFilter)) {
        this.$router.push({query: newFilter, params: {savePosition: '1'}});
        this.getTeams(newFilter);
        this.setTeamFilters(newFilter);
      }
    },
    async initFilter() {
      const games = await this.getGames();
      const teamTypes = await this.getTeamTypes();
      const { gameId, teamSizeId, page, teamId, } = this.$route.query;
      const defaultFilter = {
        gameId: gameId || (games[0] ? games[0].id : 0),
        teamSizeId: teamSizeId || (teamTypes[0] ? teamTypes[0].id : 0),
        page: page || '1',
        teamId
      };
      if (!isEqual(this.$route.query, defaultFilter)) this.$router.push({query: defaultFilter});
      await this.getTeams(defaultFilter);
      this.setTeamFilters(defaultFilter);
      if (teamId) this.setActiveTeam(+teamId);
    },
  }
};
