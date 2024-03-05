import get from 'lodash/get';
import {
  STATE_STATUSES
} from 'helpers/constants';
import snakeCase from 'lodash/snakeCase';
import dayjs from 'dayjs';
import utc from 'dayjs/plugin/utc';
dayjs.extend(utc);

export default {
  async getCurrentTournament({commit}, tournamentId) {
    try {
      commit('setTournamentsStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('tournaments/' + tournamentId);
      commit('setCurrentTournaments', get(response, 'data.data', []));
      commit('setTournamentsStatus', STATE_STATUSES.READY);
    } catch (e) {
      console.log(e);
      commit('setTournamentsStatus', STATE_STATUSES.ERROR);
    }
  },
  async getTournaments(ctx, {params, commit, isCheckStatus = true}) {
    if (isCheckStatus && ctx.state.tournamentsStatus ===  STATE_STATUSES.PENDING) return;
    const snakeCaseParams = {};

    if (params['gameMode']) {
      const gameModes = get(ctx, 'state.availableFilters.gameMode', []);

      gameModes.map(gameMode => {
        if (gameMode.id === +params['gameMode']) {
          ctx.commit('setAvailableFilters', {
            ...ctx.state.availableFilters,
            gameType: gameMode.game_types
          });
        }
      });
    }

    Object.keys(params).map(param => {
      snakeCaseParams[snakeCase(param)] = params[param];
    });

    try {
      ctx.commit('setTournamentsStatus', STATE_STATUSES.PENDING);

      const response = await this.$bangerApi.get('tournaments', {
        params: snakeCaseParams
      });
      const tournaments = get(response, 'data.data', []);
      ctx.commit(commit, {
        tournaments
      });
    } catch (e) {
      console.log(e);
      ctx.commit('setTournamentsStatus', STATE_STATUSES.ERROR);
    } finally {
      ctx.commit('setTournamentsStatus', STATE_STATUSES.READY);
    }
  },
  async getTournamentFilters({commit}, gameId) {
    await commit('setTournamentFiltersStatus', STATE_STATUSES.PENDING);
    try {
      const response = await this.$bangerApi.get(`tournaments/filters?gameId=${gameId}`);
      const filters = get(response, 'data.data', []);
      const gameType = get(response, 'data.data.gameMode[0].game_types', []);
      await commit('setAvailableFilters', {...filters, gameType});
    } catch (e) {
      console.error(e);
    } finally {
      await commit('setTournamentFiltersStatus', STATE_STATUSES.READY);
    }
  },
  async getCurrentUserTeamsTournament({commit}, params = {}) {
    let currentTournament = get(this, 'state.modal.commonData.tournament');

    if (!currentTournament) {
      console.error('CurrentTournament required');
      return;
    }
    const res = await this.$bangerApi.get(`tournaments/${currentTournament.id}/teams/user`, {
      params: {
        per_page: params.perPage,
        page: params.page,
      },
    });

    commit('setCurrentUserTeamsTournament', get(res, 'data.data', {}));
    return res;
  },
  async getCurrentTournamentTeam({commit, state}, params = {}) {
    const res = await this.$bangerApi.get(`tournaments/${state.currentTournament.id}/teams`, {
      params: {
        per_page: params.perPage || 16,
        page: params.page || 1,
      },
    });

    commit('setCurrentTournamentTeam', get(res, 'data.data', {}));
    return res;
  },
  async getCurrentTournamentRules({commit, state}) {
    commit('setCurrentTournamentRules', get(await this.$bangerApi.get(`tournaments/${state.currentTournament.id}/rules`), 'data.data.data', []));
  },
  updateTournamentFromLocation({dispatch}) {
    const route = get(window, '$nuxt.$route', {});
    const tournamentId = get(route, 'params.tournamentId');
    if (tournamentId) {
      dispatch('getCurrentTournament', tournamentId);
      return;
    }
    dispatch('getTournaments', {
      params: {...route.query},
      commit: 'setTournaments',
    });
    dispatch('getTournaments', {
      params: {featured: '1'},
      commit: 'setCarouselTournaments'
    });
  },

  async joinTournament({dispatch}, {tournamentId, teamId}) {
    try {
      await this.$bangerApi.post(`tournaments/${tournamentId}/join`, {
        team_id: teamId
      });
      dispatch('updateTournamentFromLocation', tournamentId);
      return true;
    } catch (err) {
      console.error(err);
      return false;
    }
  },

  async getBrackets({commit}) {
    commit('setStatus', STATE_STATUSES.PENDING);
    try {
      const res = await this.$bangerApi.get('/bracket-match/view-bracket-structure/1');
      commit('getBrackets', {
        1: res.data[1],
        groups_information: {
          'total_teams': 16,
          'total_groups': 1,
          'user_team_prFesent_in_group': 'A',
          'user_team_id': 46,
          'user_team_name': 'Lexi Weimann DDS'
        }
      });
      commit('setStatus', STATE_STATUSES.READY);
    } catch (err) {
      console.error(err);
      commit('setStatus', STATE_STATUSES.ERROR);
      return false;
    }
  },
  async uploadEvidance({commit},payload) {
    commit('setStatus', STATE_STATUSES.PENDING);
    try {
      await this.$bangerApi.post(`/bracket-match/upload-evidence/${payload.match_id}`,payload.formData);
      commit('setStatus', STATE_STATUSES.READY);
    } catch (err) {
      console.error(err);
      commit('setStatus', STATE_STATUSES.ERROR);
      return false;
    }
  }

};
