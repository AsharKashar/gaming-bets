import get from 'lodash/get';
import snakeCase from 'lodash/snakeCase';
import { STATE_STATUSES } from 'helpers/constants';
import Vue from 'vue';

export default {
  async getTeams ({ commit }, params) {
    const snakeCaseParams = {};

    Object.keys(params).map(param => {
      snakeCaseParams[snakeCase(param)] = params[param];
    });
    try {
      commit('setTeamsStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get('team', {params: snakeCaseParams});
      const teams = get(response, 'data.data', []);
      commit('setTeams', teams);
      commit('setTeamsStatus', STATE_STATUSES.READY);
    } catch (e) {
      console.log(e);
      commit('setTeamsStatus', STATE_STATUSES.ERROR);
    }
  },
  async getTeamTypes ({commit}) {
    commit('setTeamTypesStatus', STATE_STATUSES.PENDING);
    const res = await this.$bangerApi.get('team-size');
    const data = get(res, 'data.data', []);
    commit('setTeamTypes', data);
    commit('setTeamTypesStatus', STATE_STATUSES.READY);
    return data;
  },
  async getTeamDetails ({ commit }, teamId) {
    try {
      commit('setTeamsStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.get(`teams/${teamId}`);
      const teams = get(response, 'data.data', []);
      commit('setTeamDetails', teams);
      commit('setTeamsStatus', STATE_STATUSES.READY);
    } catch (e) {
      console.log(e);
      commit('setTeamsStatus', STATE_STATUSES.ERROR);
    }
  },
  async getFilteredTeams ({ dispatch, state }) {
    const { gameId, teamSize, page } = state.filters;

    const filters = {
      gameId,
      size: teamSize,
      perPage: 4,
      page: page || 1
    };
    dispatch('getTeams', filters);
  },
  async createTeam ({ state }, data) {
    const formData = new FormData();

    const params = {
      team_size_id: state.filters.teamSizeId,
      game_id: state.filters.gameId,
      ...data,
      members: JSON.stringify(data.members)
    };

    Object.keys(params).map(key => {
      formData.append(key, params[key]);
    });

    try {
      const teamResponse = await this.$bangerApi.post('team', formData).catch(e => {
        let errors = e.response ? e.response.data.errors : null;
        let errorDetails = [];
        if (errors) {
          Object.keys(errors).map(e => {
            errorDetails.push(errors[e]);
          });
        }

        for (const [value] of Object.entries(e.response.data.messages.name)) {
          Vue.notify({
            group: 'custom-notification',
            title: 'Error',
            text: value,
            type: 'error'
          });
        }
        return e.response;
      });
      return get(teamResponse, 'data.data', null);
    } catch (e) {
      console.log(e);
    }
  },
  async inviteMember ({ dispatch }, { teamId, email }) {
    try {
      await this.$bangerApi.post(`team/${teamId}/invite`, { email });
      dispatch('getFilteredTeams');
    } catch (e) {
      console.log(e);
    }
  },
  async deleteMember ({ dispatch }, { user_id, team_id }) {
    const params = `?user_id=${user_id}&team_id=${team_id}`;

    try {
      await this.$bangerApi.delete(`team/user${params}`);
      dispatch('getFilteredTeams');
    } catch (e) {
      console.log(e);
    }
  },

  async deleteInvite ({ dispatch }, inviteId) {
    try {
      await this.$bangerApi.delete(`/team/${inviteId}/invite`);
      dispatch('getFilteredTeams');
    } catch (e) {
      console.log(e);
    }
  },

  async joinTeamByTeamToken (ctx, token) {
    try {
      await this.$bangerApi.post('team/join/team-token', { team_token: token });
      this.$router.push('/profile/teams');
    } catch (e) {
      console.log(e);
      this.$router.push('/');
    }
  }
};
