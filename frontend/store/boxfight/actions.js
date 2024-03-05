import get from 'lodash/get';
import {
  STATE_STATUSES
} from 'helpers/constants';
import dayjs from 'dayjs'; 
import utc from 'dayjs/plugin/utc';
dayjs.extend(utc);

export default {
  async getBoxFights({commit}, {payload , params}) {
    commit('setBoxFightStatus', STATE_STATUSES.PENDING);

    // making default perpage 8 boxfights
    if(!payload.per_page){
      payload.per_page = 8;
    }

    try {
      const response = await this.$bangerApi.post(
        'box-matches/view-boxfights-user?page=' + params.page,
        payload
      );

      const activeMatches = get(response, 'data[\'Active Matches\'].data', []);
      const liveMatches = get(response, 'data[\'Live Matches\']', []);
      let matches = [...activeMatches, ...liveMatches];
      // converting time UTC to LOCAL
      matches = matches.filter(match => {
        match.time = dayjs
          .utc(match.time)
          .local()
          .format('YYYY-MM-DD HH:mm');
        return match.status !== '5';
      });

      commit('setBoxFights', matches);

      // setting the pagination data
      let pagination =  get(response, 'data[\'Active Matches\']', {});
      delete pagination.data;
      commit('setBoxFightPagination', pagination);
      commit('setBoxFightStatus', STATE_STATUSES.READY);
    } catch (err) {
      commit('setBoxFightStatus', STATE_STATUSES.ERROR);
      console.log(err);
    }
  },
  async getCurrentBoxFight({commit}, {match_id, user_id}) {
    try {
      commit('setBoxFightStatus', STATE_STATUSES.PENDING);
      const response = await this.$bangerApi.post(
        `box-matches/view-boxfight-with-remark/${match_id}`, {
          user_id
        }
      );
      let data = response.data;
      // converting time UTC to LOCAL
      data.time = dayjs.utc(data.time).local().format('YYYY-MM-DD HH:mm');
      commit('setCurrentBoxFight', data);
      commit('setBoxFightStatus', STATE_STATUSES.READY);
    } catch (err) {
      console.log(err);
      commit('setBoxFightStatus', STATE_STATUSES.ERROR);
    }
  },
  async getBoxFightTeams({commit}, payload) {
    try {
      commit('setBoxFightStatus', STATE_STATUSES.PENDING);
      const teams = await this.$bangerApi.get(`box-matches/view-boxfight-team/${payload}`);
      commit('setCurrentBoxFightTeams', teams.data);
      commit('setBoxFightStatus', STATE_STATUSES.READY);
    } catch (err) {
      console.log(err);
      commit('setBoxFightStatus', STATE_STATUSES.ERROR);
    }
  },
};
